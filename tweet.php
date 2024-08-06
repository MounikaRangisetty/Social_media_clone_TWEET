<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Get the user's ID
$stmt = $conn->prepare("SELECT id FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$user_id = $user['id'];

// Handle new tweet submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tweet'])) {
    $tweet_content = $_POST['tweet'];
    $tweet_image = null;
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $image_target = "images/" . $image_name;
        
        if (move_uploaded_file($image_tmp, $image_target)) {
            $tweet_image = $image_name;
        }
    }
    
    $stmt = $conn->prepare("INSERT INTO tweets (user_id, content, image) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $tweet_content, $tweet_image);
    $stmt->execute();
}

// Get tweets from the user and those they follow
$stmt = $conn->prepare("SELECT t.*, u.username FROM tweets t JOIN users u ON t.user_id = u.id WHERE t.user_id = ? OR t.user_id IN (SELECT followed_id FROM follows WHERE follower_id = ?) ORDER BY t.created_at DESC");
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$tweets = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Tweet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Tweet</h1>
        <nav>
            <a href="profile.php?username=<?php echo urlencode($username); ?>">Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <br>
    <div class="container">
        <h2>Post a New Tweet</h2>
        <form method="post" enctype="multipart/form-data">
            <textarea name="tweet" rows="4" placeholder="What's happening?" required></textarea>
            <input type="file" name="image">
            <button type="submit">Tweet</button>
        </form>

        <h2>Your Tweets and Tweets from People You Follow</h2>
        <?php while ($tweet = $tweets->fetch_assoc()) { ?>
            <div class="tweet">
                <p><strong><?php echo htmlspecialchars($tweet['username']); ?>:</strong> <?php echo htmlspecialchars($tweet['content']); ?></p>
                <?php if ($tweet['image']) { ?>
                    <img src="images/<?php echo htmlspecialchars($tweet['image']); ?>" alt="Tweet Image">
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>

<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>BlogXSS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        button[type="submit"], button[type="button"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover, button[type="button"]:hover {
            background-color: #0056b3;
        }
        .comments {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .comment {
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .comment p {
        margin-bottom: 10px;
        font-size: 16px;
        line-height: 1.6;
    }

    .comment img {
        max-width: 100%;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    </style>
</head>
<body>
    <!-- HTML code for the user interface -->
    <div style="text-align: right; padding: 10px;">
         <?php echo isset($_GET['username']) ? ($_GET['username']) : ($_SESSION['username']); ?>
         <form action="/account" method="get" style="display: inline;">
            <button type="account">Account</button>
         </form>
    </div>
    <div class="container">
    
    <h1>Insert new Post</h1>
    <form id="postForm" enctype="multipart/form-data">
        <label for="comment">Comment:</label>
        <input type="text" id="comment" name="comment" required><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br>
        <button type="submit">Submit</button>
    </form>
    <form id="clearForm" action='/api/clearposts' method='post' >
        <button type="submit">Clear</button>
    </form>

    <h2>Recent Posts</h2>
    <div id="postsContainer"></div>

    <script>
        document.getElementById('postForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            const response = await fetch('/api/createpost', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                loadPosts();
            } else {
                alert('Errore durante la pubblicazione del post.');
            }
        });

        async function loadPosts() {
            const response = await fetch('/api/getposts');
            console.log(response);
            const posts = await response.json();
            console.log(posts);
            const postsContainer = document.getElementById('postsContainer');
            postsContainer.innerHTML = '';
            posts.forEach(post => {
                const postElement = document.createElement('div');
                postElement.innerHTML = `
                    <p>${post.username}</p> 
                    ${post.comment}
                    <img src="${post.imageUrl}" alt="No image" style="max-width: 100%;">
                `;
                postsContainer.appendChild(postElement);
            });
        }

        document.addEventListener('DOMContentLoaded', loadPosts);
    </script>
</body>
</html>

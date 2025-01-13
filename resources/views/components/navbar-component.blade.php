<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        /* Navbar Starts */

/* Basic styling for the navbar */
.navbar {
    background-color: #44abb8;
    overflow: hidden;
  }

  /* Navbar links */
  .navbar a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
    transition: background-color 0.3s;
  }

  /* Change background color on hover */
  .navbar a:hover {
    background-color: #ddd;
    color: #333;
  }

/* Navbar Ends */
    </style>
</head>
<body>
    <div class="navbar">
        <a href="/movie-page">Movie Page - Browse Movies</a>
        <a href="/recommend-other">Recommend Other</a>
        <a href="/recommend-me">Recommend Me</a>
        <a href="/dashboard">Dashboard</a>
      </div>

      {{ $slot }}
</body>
</html>

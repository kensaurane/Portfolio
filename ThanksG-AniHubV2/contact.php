<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact us - Easy Tutorials Youtube channel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Academy+Engraved+LET&family=Roboto:wght@100&display=swap">
</head>
<body>

<style>
    
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background: grey;
        font-size: 14px;
        font-family: 'Academy Engraved LET', sans-serif;
        font-family: 'Roboto', sans-serif;
    }

    .container {
        width: 80%;
        margin: 50px auto;
    }

    .contact-box {
        background: #fff;
        display: flex;
    }

    .contact-left {
        flex-basis: 60%;
        padding: 40px 60px;
    }

    .contact-right {
        flex-basis: 40%;
        padding: 40px;
        background: black;
        color: #fff;
    }

    h1 {
        margin-bottom: 10px;
    }

    .container p {
        margin-bottom: 40px;
    }

    .input-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .input-row .input-group {
        flex-basis: 45%;
    }

    input,
    textarea {
        width: 100%;
        border: none;
        border-bottom: 1px solid #ccc;
        outline: none;
        padding-bottom: 5px;
        margin-top: 6px; /* Adjusted margin-top for better spacing */
    }

    label {
        margin-bottom: 6px;
        display: block;
        color: #1c00b5; /* Corrected color code */
    }

    button {
        background: black;
        width: 100px;
        border: none;
        outline: none;
        color: #fff;
        height: 35px;
        border-radius: 30px;
        margin-top: 20px;
        box-shadow: 0px 5px 15px rgba(28, 0, 181, 0.3);
        cursor: pointer; /* Added cursor pointer */
    }

    .contact-left h3 {
        color: #1c00b5;
        font-weight: 600;
        margin-bottom: 30px;
    }

    .contact-right h3 {
        font-weight: 600;
        margin-bottom: 30px;
    }

    table {
        width: 100%; /* Adjusted table width */
    }

    tr td:first-child {
        padding-right: 20px;
    }

    tr td {
        padding-top: 20px;
    }

/* Update the navigation bar */
nav {
    background: black; /* Change the background color to black */
    padding: 15px 0; /* Add padding for better spacing */
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
}

nav ul li {
    margin: 0 15px; /* Adjusted margin for menu items */
}

nav ul li a {
    text-decoration: none;
    color: white; /* Set text color to white */
    font-weight: bold; /* Make the text bold */
    font-size: 16px; /* Increase font size */
    padding: 8px 15px; /* Add padding for the buttons */
    border-radius: 5px; /* Add some border-radius for a rounded button appearance */
}

nav ul li a:hover {
    background: orange; /* Change hover background color */
    color: black; /* Change text color on hover for better visibility */
}

h1 {
    margin-bottom: 10px;
    color: #1c00b5; /* Change text color for h1 */
    font-size: 28px; /* Increase font size for h1 */
    font-weight: bold; /* Make h1 text bold */
}

.container p {
    margin-bottom: 40px;
    color: #000; /* Change text color for paragraphs */
    line-height: 1.6; /* Increase line height for better readability */
}



</style>

<nav>
                    <ul id="MenuItems">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about_us.php">About Us</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="account.php">Account</a></li>
                        <li><a href="logout.php">logout</a></li>
                    </ul>
                </nav>

<div class="container">
    <h1>Connect With Us</h1>
    <p>We would love to respond to your queries and help you succeed.<br>Feel free to get in touch with us.</p>
    <div class="contact-box">
        <div class="contact-left">
            <h3>Send your request</h3>
            <form>
                <div class="input-row">
                    <div class="input-group">
                        <label>Name</label>
                        <input type="text" placeholder="Name">
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <label>Phone</label>
                        <input type="text" placeholder="Phone Number">
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" placeholder="Email Address">
                    </div>
                </div>

                
                <label>Message</label>
                <textarea rows="5" placeholder="Your Message"></textarea>
                <button type="submit">SEND</button>
            </form>
        </div>
        <div class="contact-right">
            <h3>Reach Us</h3>
            <table>
                <tr>
                    <td>Email</td>
                    <td>AniHub@gmail.com</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>+0956 671 1356</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>#178, Basud, Purok Tamglad<br>Some layout, Some Road, Polanguia<br>Albay 560001</td>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>
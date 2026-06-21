<?php include('partials-frontend/menu.php'); ?>
<script>
function validateEmail() {
  email = document.getElementById('email').value;
  if (email.includes("@") && email.includes(".")) {
    return true;
  } else {
    alert("Please enter a valid email with a domain like .com");
    return false;
  }
}
</script>

  
    <section class=" contact">
        

        <div class="connect">
           
            <h1 class="contacthead">Connect With Us</h1>
            <p class="contactpara">We would love to respond to your queries and help you succeed.Feel free to get in touch
            with us.</p>
         
         </div>
      
         <div class="container">
         <div class="contactform contact-container contact-left">
            <h2>Send Your Request</h2>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "<script>alert('Your message has been sent successfully!');</script>";
            }
            ?>
            <form action="" method= "POST" onsubmit="return validateEmail()">
            <div class="input-row">
                <div class="input-group">
                <label for="name">Name</label>
                <input class="inputfield"  type="text" pattern="^[A-Za-z\s]+$" title="Only letters and spaces are allowed" required>
            </div>
            <div class="input-group">
                <label for="phone">Phone</label>
                <input class="inputfield"  type="text"  pattern="\d{10}" 
    title="Phone number must be exactly 10 digits" required >
                </div>
            </div>
            <div class="input-row">
            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" class="inputfield" type="email">
            </div>
        </div>
                <label for="msg">Message</label>
                <textarea name="additional" rows="5" required></textarea>
                <button class="btn btn-primary pad"name="submit" type="submit">Send</button>
            </form>
         </div>
         
         <div class="reach contact-container contact-right">
            <h2>Reach us</h2>
            <table>
                <tr>
                    <td>Email</td>
                    <td>spiceandsoul1@gmail.com</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>9848056372</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>Baneshwor,Kathmandu</td>
                </tr>
            </table>
         </div>
        </div>
         <div class="clearfix"></div>

    </section>

    <?php include('partials-frontend/footer.php'); ?>
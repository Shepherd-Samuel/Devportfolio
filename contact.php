<?php 
include '../header.php'; 
include '../db.php';

// Initialize variables
$name = $email = $subject = $message = "";
$successMsg = $errorMsg = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Email settings
            $to = "mutavatosh@gmail.com"; // Change to your email
            $headers = "From: $name <$email>\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $emailBody = "
                <h3>New Contact Message</h3>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Subject:</strong> {$subject}</p>
                <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
            ";

            if (mail($to, $subject, $emailBody, $headers)) {
                $successMsg = "Your message has been sent successfully. We will get back to you soon!";
                $name = $email = $subject = $message = ""; // Reset form
            } else {
                $errorMsg = "Sorry, your message could not be sent. Please try again later.";
            }
        } else {
            $errorMsg = "Please enter a valid email address.";
        }
    } else {
        $errorMsg = "All fields are required.";
    }
}
?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Contact Us</h2>

    <?php if ($successMsg): ?>
        <div class="alert alert-success"><?php echo $successMsg; ?></div>
    <?php elseif ($errorMsg): ?>
        <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
    <?php endif; ?>

    <div class="row">
        <!-- Contact Form -->
        <div class="col-md-8">
            <form method="POST" action="contact.php" class="shadow p-4 rounded bg-white">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control" value="<?php echo htmlspecialchars($subject); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-control" rows="5" required><?php echo htmlspecialchars($message); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary px-4">Send Message</button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="col-md-4">
            <div class="p-4 bg-light rounded shadow-sm">
                <h5>Our Office</h5>
                <p>123 Example Street,<br> Nairobi, Kenya</p>
                <h5>Email</h5>
                <p>support@example.com</p>
                <h5>Phone</h5>
                <p>+254 700 000 000</p>
                <h5>Follow Us</h5>
                <p>
                    <a href="#" class="me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="me-2"><i class="bi bi-instagram"></i></a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>

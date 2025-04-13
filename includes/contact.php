<!-- contact.php -->
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-body p-5">
                    <h3 class="card-title text-center mb-4">Contact Us</h3>
                    <p class="text-center text-muted mb-4">
                        Have questions or need help? Reach out and we'll get back to you as soon as possible.
                    </p>
                    <form action="includes/thankyou.php" method="POST">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </form>
                    <hr class="mt-5">
                    <div class="text-center">
                        <p><strong>Address:</strong> Manila, Philippines</p>
                        <p><strong>Email:</strong> support@tinycollege.com</p>
                        <p><strong>Phone:</strong> +63 912 345 6789</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

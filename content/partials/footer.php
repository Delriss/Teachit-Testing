    <!-- Footer -->
    <footer class="footer mt-auto py-3 rounded-top bgColour">
        <div class="container text-center">
            <?php if($activatedPage == "Home") { ?>
                <span class="text-muted">Contact us at: SEF@ucw.ac.uk - 07123 123123</span> <br>
            <?php } ?>
            <span class="text-muted">TeachIt Testing &copy; 2021</span>
            <span class="text-muted"><a href="/privacy-policy">Privacy Policy</a></span>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Background Circles -->
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <!-- End Background Circles -->
</body>


<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- only include script if the page is the login or registration page -->
<?php if($activatedPage == "Login" || $activatedPage == "Registration") {
    echo('<script src="https://www.google.com/recaptcha/api.js?render=6LdzWYIpAAAAABoryfzQlrNtF24Jd9FB2EGlHdUX"></script>');
} 
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>

<!-- JS using routing -->
<!-- only include script if the page is the test selection or test management page -->
<?php if($activatedPage == "Test Selection" || $activatedPage == "Test Management") {
    echo('<script src="/public_static/js/test-management.js"></script>');
}
?>
<script src="/public_static/js/scripts.js"></script>

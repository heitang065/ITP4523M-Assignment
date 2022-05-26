<?php include '../include/customer/header.php' ?>
    <section id="home">
        <div class="map">
            <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map"
                    scrolling="no"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d236161.0984849364!2d113.98761593154097!3d22.352980760615328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403e2eda332980f%3A0xf08ab3badbeac97c!2sHong%20Kong!5e0!3m2!1sen!2sus!4v1623156567481!5m2!1sen!2sus"
                    style="filter: grayscale(0.3) contrast(1.2) opacity(0.4);"></iframe>
        </div>
        <div class="content-container">
            <h2>Hello! <?php echo $_SESSION["username"]?></h2>
            <h2>Welcome to</h2>
            <h2>Eastern Delivery Express System</h2>
        </div>
    </section>
<?php include '../include/customer/footer.php' ?>
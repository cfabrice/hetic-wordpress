<?php /* Template Name: Template Contact */ ?>

<?php get_header(); ?>
    <main class="main contact">
        <div class="full-image">
            <img src="./assets/img/JR-exhib.png" alt="image name">
        </div>
        <div class="section--title">
            contact
        </div>
        <form action="#" class="contact-form">
            <p class="contact-input">
                <label for="name">name</label>
                <input type="text" id="name" placeholder="Name" required>
            </p>
            <p class="contact-input">
                <label for="mail">email</label>
                <input type="mail" id="mail" placeholder="exemple@gmail.com" required>
            </p>
            <p class="contact-input">
                <label for="subject">subject</label>
                <input type="text" id="subject" placeholder="Subject" required>
            </p>
            <p class="contact-input">
                <label for="type">category</label>
                <select id="type" required>
                    <option value="1">type</option>
                    <option value="2">type</option>
                    <option value="3">type</option>
                    <option value="4">type</option>
                </select>
            </p>
            <p class="contact-text">
                <label for="message">message</label>
                <textarea name="message" id="message" class="scroll-disable"></textarea>
            </p>
            <input type="submit" value="Send">
        </form>
    </main>
<?php get_footer(); ?>
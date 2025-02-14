<div id="footer" class="w-100 d-flex justify-content-center">
    <p class="text-dark m-0 py-3">
        Copyright &copy; 2005 -2025 SFi Group. All rights reserved.
    </p>
</div>

<script src="<?= PUBLIC_PATH; ?>/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById("toggle-nav").addEventListener("click", function() {
        const body = document.body;
        if (body.style.gridTemplateColumns === "7% 93%") {
            body.style.gridTemplateColumns = "17% 83%";
        } else {
            body.style.gridTemplateColumns = "7% 93%";
        }

        const buttonNavIcon = document.getElementById("button-nav-icon");
        if (buttonNavIcon.classList.contains("bi-list")) {
            buttonNavIcon.classList.remove("bi-list");
            buttonNavIcon.classList.add("bi-arrow-bar-right");
        } else {
            buttonNavIcon.classList.remove("bi-arrow-bar-right");
            buttonNavIcon.classList.add("bi-list");
        }

        const logoNavbar = document.getElementById("logo-navbar");
        const logoPath = logoNavbar.getAttribute("src");

        if (logoPath.includes("logo-sfi3.png")) {
            logoNavbar.setAttribute("src", "<?= PUBLIC_PATH; ?>/img/logo-sfi2.png");
            logoNavbar.style.width = "3rem";
        } else {
            logoNavbar.setAttribute("src", "<?= PUBLIC_PATH; ?>/img/logo-sfi3.png");
            logoNavbar.style.width = "12rem";
        }

        const navLinks = ["nav-link1", "nav-link2", "nav-link3"];
        navLinks.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                const span = element.querySelector('span');
                if (span) {
                    span.classList.toggle("d-none");
                }

                if (element.classList.contains('justify-content-start')) {
                    element.classList.remove('justify-content-start');
                    element.classList.add('justify-content-center');
                } else if (element.classList.contains('justify-content-center')) {
                    element.classList.remove('justify-content-center');
                    element.classList.add('justify-content-start');
                }
            }
        });

    });
</script>
</body>

</html>
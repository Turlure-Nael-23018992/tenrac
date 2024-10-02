<footer class="footer">
    <p>© 2024 - Tenrac</p>
    <p>Fait avec ❤️</p>
</footer>
<script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById('editModal');
                var span = document.getElementsByClassName('close')[0];

                document.querySelectorAll('.edit-btn').forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();

                        var card = this.closest('.card');
                        var idTenrac = card.querySelector('input[name="id_tenrac"]').value;
                        var nom = card.querySelector('h2').innerText;
                        var couriel = card.querySelector('p:nth-of-type(1)').innerText.replace("Email :", "").trim();
                        var tel = card.querySelector('p:nth-of-type(2)').innerText.replace("Téléphone :", "").trim();
                        var adresse = card.querySelector('p:nth-of-type(3)').innerText.replace("Adresse :", "").trim();
                        var grade = card.querySelector('p:nth-of-type(4)').innerText.replace("Grade :", "").trim();

                        document.getElementById('edit_id_tenrac').value = idTenrac;
                        document.getElementById('edit_nom').value = nom;
                        document.getElementById('edit_couriel').value = couriel;
                        document.getElementById('edit_tel').value = tel;
                        document.getElementById('edit_adresse').value = adresse;
                        document.getElementById('edit_grade').value = grade;

                        modal.style.display = "block";
                    });
                });

                span.onclick = function() {
                    modal.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            });
        </script>
        <script>

let header = document.querySelector("header")

document.addEventListener("scroll", () => {
    header.classList.toggle("sticky", window.scrollY > 0)
})

window.addEventListener('scroll', function () {
    const scrollPosition = window.scrollY;
    const maxScroll = document.body.scrollHeight - window.innerHeight; 

    const angle = 171 + (scrollPosition / maxScroll) * 360 / 6;

    document.querySelector('.header').style.background = `linear-gradient(${angle}deg, rgba(194,49,21,1) 0%, rgba(85,16,39,1) 100%)`;
});
</script>

<script src="/_assets/scripts/login.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="/_assets/scripts/login.js"></script>
</html>
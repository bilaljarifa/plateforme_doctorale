<!-- Professional Footer Component -->
<footer class="bg-dark text-white py-5 mt-5">
    <div class="container-fluid">
        <div class="row">
            <!-- About Section -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-building me-2"></i>À Propos
                </h5>
                <p class="text-muted">Portail des Études Doctorales - Université Ibn Tofail. Votre plateforme pour l'excellence académique.</p>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-link-45deg me-2"></i>Liens Rapides
                </h5>
                <ul class="list-unstyled">
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="text-decoration-none text-light">Dashboard</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-decoration-none text-light">Articles</a></li>
                        <li><a href="{{ route('these') }}" class="text-decoration-none text-light">Thèse</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-decoration-none text-light">Connexion</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-telephone me-2"></i>Contact
                </h5>
                <ul class="list-unstyled text-muted">
                    <li><i class="bi bi-geo-alt me-2"></i>Université Ibn Tofail, Kénitra</li>
                    <li><i class="bi bi-envelope me-2"></i>support@uit.ac.ma</li>
                    <li><i class="bi bi-telephone me-2"></i>+212 (0)5 37 44 85 53</li>
                </ul>
            </div>

            <!-- Social Media -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-share me-2"></i>Suivez-nous
                </h5>
                <div class="d-flex gap-3">
                    <a href="#" class="text-light" style="font-size: 1.5rem;">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="text-light" style="font-size: 1.5rem;">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="text-light" style="font-size: 1.5rem;">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="#" class="text-light" style="font-size: 1.5rem;">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <hr class="bg-light my-4">

        <!-- Bottom Section -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-muted mb-0">&copy; 2025 Université Ibn Tofail. Tous droits réservés.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-muted text-decoration-none me-3">Politique de Confidentialité</a>
                <a href="#" class="text-muted text-decoration-none">Conditions d'Utilisation</a>
            </div>
        </div>
    </div>
</footer>

<style>
footer {
    background: linear-gradient(135deg, #0052a3 0%, #0066cc 100%);
    margin-top: auto;
}

footer h5 {
    color: #fff;
    font-weight: 700;
    border-bottom: 2px solid #0099ff;
    padding-bottom: 0.5rem;
}

footer a {
    color: #b3d9ff;
    text-decoration: none;
    transition: all 0.3s ease;
}

footer a:hover {
    color: #fff;
    text-decoration: underline;
}

footer .text-muted {
    color: #a8c5e0 !important;
}

footer hr {
    border-color: rgba(255, 255, 255, 0.1);
}

@media (max-width: 768px) {
    footer .col-lg-3,
    footer .col-md-6 {
        margin-bottom: 1.5rem;
    }

    footer .text-md-start,
    footer .text-md-end {
        text-align: center !important;
    }
}
</style>

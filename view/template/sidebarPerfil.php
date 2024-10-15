
<div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <div class="right-section"> <!-- Contenedor para agrupar elementos a la derecha -->
                <input type="checkbox" id="theme-toggle" hidden>
                <label for="theme-toggle" class="theme-toggle"></label>
                <div class="profilel">
                    <div class="info">
                      <?php if(isset($_SESSION['user'])):?>
                          <p><b><?php echo $_SESSION['user']['email'];?></b></p>
                          <small class="text-muted">Admin</small>
                      <?php endif; ?>
                    </div>
                </div>
                <a href="#" class="profile">
                    <img src="asset\images\logo.jpg">
                </a>
            </div>
        </nav>
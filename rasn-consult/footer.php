<?php
/**
 * The template for displaying the footer
 *
 * @package RASN_Consult
 */
?>

  <script>
    function openDrawer() {
      const drawer = document.getElementById('drawer');
      const backdrop = document.getElementById('drawerBackdrop');
      const btn = document.getElementById('hamburgerBtn');
      if (drawer) drawer.classList.add('is-open');
      if (backdrop) backdrop.classList.add('is-open');
      if (drawer) drawer.setAttribute('aria-hidden', 'false');
      if (btn) btn.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
      const drawer = document.getElementById('drawer');
      const backdrop = document.getElementById('drawerBackdrop');
      const btn = document.getElementById('hamburgerBtn');
      if (drawer) drawer.classList.remove('is-open');
      if (backdrop) backdrop.classList.remove('is-open');
      if (drawer) drawer.setAttribute('aria-hidden', 'true');
      if (btn) btn.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeDrawer();
    });

    class ParticleGalaxy {
        constructor() {
            this.canvas = document.getElementById('particleCanvas');
            this.ctx = this.canvas.getContext('2d');
            this.particles = [];
            this.mouse = { x: 0, y: 0 };
            this.colorSchemes = [
                ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57'],
                ['#ff9ff3', '#54a0ff', '#5f27cd', '#00d2d3', '#ff9f43'],
                ['#ff3838', '#ff9500', '#ffdd59', '#32ff7e', '#7efff5'],
                ['#fd79a8', '#fdcb6e', '#6c5ce7', '#74b9ff', '#00b894'],
                ['#ff7675', '#fd79a8', '#fdcb6e', '#00b894', '#74b9ff']
            ];
            this.currentColorScheme = 0;
            this.speedMultiplier = 1;
            this.connectionDistance = 120;

            this.init();
            this.setupEventListeners();
            this.animate();
        }

        init() {
            this.resizeCanvas();
            this.createParticles();
        }

        resizeCanvas() {
            this.canvas.width = window.innerWidth;
            this.canvas.height = window.innerHeight;
        }

        createParticles() {
            this.particles = [];
            const particleCount = Math.min(150, Math.floor((this.canvas.width * this.canvas.height) / 10000));

            for (let i = 0; i < particleCount; i++) {
                this.particles.push({
                    x: Math.random() * this.canvas.width,
                    y: Math.random() * this.canvas.height,
                    vx: (Math.random() - 0.5) * 2,
                    vy: (Math.random() - 0.5) * 2,
                    size: Math.random() * 3 + 1,
                    color: this.getRandomColor(),
                    opacity: Math.random() * 0.8 + 0.2,
                    originalVx: (Math.random() - 0.5) * 2,
                    originalVy: (Math.random() - 0.5) * 2,
                    pulse: Math.random() * Math.PI * 2
                });
            }
        }

        getRandomColor() {
            const colors = this.colorSchemes[this.currentColorScheme];
            return colors[Math.floor(Math.random() * colors.length)];
        }

        setupEventListeners() {
            window.addEventListener('resize', () => {
                this.resizeCanvas();
                this.createParticles();
            });

            this.canvas.addEventListener('mousemove', (e) => {
                this.mouse.x = e.clientX;
                this.mouse.y = e.clientY;
            });

            this.canvas.addEventListener('mouseleave', () => {
                this.mouse.x = -1000;
                this.mouse.y = -1000;
            });

            document.getElementById('colorBtn').addEventListener('click', () => {
                this.changeColorScheme();
            });

            document.getElementById('speedBtn').addEventListener('click', () => {
                this.toggleSpeed();
            });

            document.getElementById('resetBtn').addEventListener('click', () => {
                this.reset();
            });
        }

        changeColorScheme() {
            this.currentColorScheme = (this.currentColorScheme + 1) % this.colorSchemes.length;
            this.particles.forEach(particle => {
                particle.color = this.getRandomColor();
            });
        }

        toggleSpeed() {
            this.speedMultiplier = this.speedMultiplier === 1 ? 3 : 1;
        }

        reset() {
            this.createParticles();
            this.speedMultiplier = 1;
            this.currentColorScheme = 0;
        }

        updateParticles() {
            this.particles.forEach(particle => {
                // Mouse interaction
                const dx = this.mouse.x - particle.x;
                const dy = this.mouse.y - particle.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                const maxDistance = 150;

                if (distance < maxDistance) {
                    const force = (maxDistance - distance) / maxDistance;
                    const angle = Math.atan2(dy, dx);
                    particle.vx -= Math.cos(angle) * force * 0.5;
                    particle.vy -= Math.sin(angle) * force * 0.5;
                } else {
                    // Return to original velocity gradually
                    particle.vx += (particle.originalVx - particle.vx) * 0.02;
                    particle.vy += (particle.originalVy - particle.vy) * 0.02;
                }

                // Update position
                particle.x += particle.vx * this.speedMultiplier;
                particle.y += particle.vy * this.speedMultiplier;

                // Boundary wrapping
                if (particle.x < 0) particle.x = this.canvas.width;
                if (particle.x > this.canvas.width) particle.x = 0;
                if (particle.y < 0) particle.y = this.canvas.height;
                if (particle.y > this.canvas.height) particle.y = 0;

                // Pulse effect
                particle.pulse += 0.02;
                particle.currentSize = particle.size + Math.sin(particle.pulse) * 0.5;
            });
        }

        drawParticles() {
            this.particles.forEach(particle => {
                this.ctx.save();
                this.ctx.globalAlpha = particle.opacity;
                this.ctx.fillStyle = particle.color;
                this.ctx.shadowBlur = 15;
                this.ctx.shadowColor = particle.color;

                this.ctx.beginPath();
                this.ctx.arc(particle.x, particle.y, particle.currentSize, 0, Math.PI * 2);
                this.ctx.fill();
                this.ctx.restore();
            });
        }

        drawConnections() {
            for (let i = 0; i < this.particles.length; i++) {
                for (let j = i + 1; j < this.particles.length; j++) {
                    const particle1 = this.particles[i];
                    const particle2 = this.particles[j];

                    const dx = particle1.x - particle2.x;
                    const dy = particle1.y - particle2.y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < this.connectionDistance) {
                        const opacity = (this.connectionDistance - distance) / this.connectionDistance * 0.3;

                        this.ctx.save();
                        this.ctx.globalAlpha = opacity;
                        this.ctx.strokeStyle = particle1.color;
                        this.ctx.lineWidth = 1;
                        this.ctx.shadowBlur = 5;
                        this.ctx.shadowColor = particle1.color;

                        this.ctx.beginPath();
                        this.ctx.moveTo(particle1.x, particle1.y);
                        this.ctx.lineTo(particle2.x, particle2.y);
                        this.ctx.stroke();
                        this.ctx.restore();
                    }
                }
            }
        }

        drawMouseEffect() {
            if (this.mouse.x === -1000) return;

            const gradient = this.ctx.createRadialGradient(
                this.mouse.x, this.mouse.y, 0,
                this.mouse.x, this.mouse.y, 100
            );
            gradient.addColorStop(0, 'rgba(255, 255, 255, 0.1)');
            gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

            this.ctx.save();
            this.ctx.fillStyle = gradient;
            this.ctx.beginPath();
            this.ctx.arc(this.mouse.x, this.mouse.y, 100, 0, Math.PI * 2);
            this.ctx.fill();
            this.ctx.restore();
        }

        animate() {
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

            this.updateParticles();
            this.drawConnections();
            this.drawParticles();
            this.drawMouseEffect();

            requestAnimationFrame(() => this.animate());
        }
    }

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        new ParticleGalaxy();
    });

    // Add some extra sparkle effects
    class SparkleEffect {
        constructor() {
            this.sparkles = [];
            this.canvas = document.getElementById('particleCanvas');
            this.ctx = this.canvas.getContext('2d');

            setInterval(() => this.createSparkle(), 500);
            setInterval(() => this.updateSparkles(), 16);
        }

        createSparkle() {
            if (this.sparkles.length < 20) {
                this.sparkles.push({
                    x: Math.random() * this.canvas.width,
                    y: Math.random() * this.canvas.height,
                    size: Math.random() * 2 + 1,
                    opacity: 1,
                    decay: Math.random() * 0.02 + 0.01
                });
            }
        }

        updateSparkles() {
            this.sparkles = this.sparkles.filter(sparkle => {
                sparkle.opacity -= sparkle.decay;

                if (sparkle.opacity > 0) {
                    this.ctx.save();
                    this.ctx.globalAlpha = sparkle.opacity;
                    this.ctx.fillStyle = '#ffffff';
                    this.ctx.shadowBlur = 10;
                    this.ctx.shadowColor = '#ffffff';

                    this.ctx.beginPath();
                    this.ctx.arc(sparkle.x, sparkle.y, sparkle.size, 0, Math.PI * 2);
                    this.ctx.fill();
                    this.ctx.restore();

                    return true;
                }
                return false;
            });
        }
    }

    // Initialize sparkle effect
    setTimeout(() => {
        new SparkleEffect();
    }, 1000);

  </script>

<?php
$footer_logo         = get_field('footer_logo', 'option');
$footer_desc         = get_field('footer_description', 'option');
$footer_social       = get_field('footer_social_links', 'option');
$footer_menu_1_title = get_field('footer_menu_1_title', 'option') ?: 'Quick Links';
$footer_menu_1       = get_field('footer_menu_1', 'option');
$footer_menu_2_title = get_field('footer_menu_2_title', 'option') ?: 'Products';
$footer_menu_2       = get_field('footer_menu_2', 'option');
$footer_contact_title= get_field('footer_contact_title', 'option') ?: 'Contact Us';
$footer_contact_info = get_field('footer_contact_info', 'option');
$footer_copyright    = get_field('footer_copyright', 'option') ?: '&copy; ' . date('Y') . ' RASN Consult. All right reserved';
?>

  <!-- ====== FOOTER ====== -->
  <footer class="site-footer">
    <div class="container">
      <div class="row g-5">

        <!-- Col 1 — Logo + About -->
        <div class="col-lg-4 col-md-6">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
            <?php if ( $footer_logo ) : ?>
              <img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php bloginfo('name'); ?> Footer Logo" style="max-height: 48px;" />
            <?php else : ?>
              <svg width="42" height="42" viewBox="0 0 44 44" fill="none">
                <rect width="44" height="44" rx="6" fill="#0d2a4a"/>
                <path d="M8 36L14 8H22L28 26L34 8H40" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                <path d="M6 22h10" stroke="#3b9eff" stroke-width="2.5" stroke-linecap="round"/>
              </svg>
              <div class="footer-logo__text">
                <span class="brand">RASN</span>
                <span class="sub">CONSULT</span>
                <span class="tagline">Make it easy</span>
              </div>
            <?php endif; ?>
          </a>

          <?php if ( $footer_desc ) : ?>
            <p class="footer-about">
              <?php echo nl2br( esc_html( $footer_desc ) ); ?>
            </p>
          <?php endif; ?>

          <?php if ( $footer_social ) : ?>
            <div class="footer-social">
              <span>Follow us:</span>
              <?php foreach ( $footer_social as $social ) : ?>
                <a href="<?php echo esc_url( $social['url'] ); ?>" aria-label="<?php echo esc_attr( $social['label'] ); ?>" target="_blank" rel="noopener noreferrer">
                  <?php echo $social['icon']; ?>
                </a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- Col 2 — Quick Links -->
        <div class="col-lg-2 col-md-3 col-6">
          <h4 class="footer-col__title"><?php echo esc_html( $footer_menu_1_title ); ?></h4>
          <?php
            $menu_1_args = array(
              'theme_location' => 'footer_1',
              'menu_class'     => 'footer-links',
              'container'      => false,
              'fallback_cb'    => false,
            );
            if ( $footer_menu_1 ) {
              $menu_1_args['menu'] = $footer_menu_1;
            }
            wp_nav_menu( $menu_1_args );
          ?>
        </div>

        <!-- Col 3 — Products -->
        <div class="col-lg-2 col-md-3 col-6">
          <h4 class="footer-col__title"><?php echo esc_html( $footer_menu_2_title ); ?></h4>
          <?php
            $menu_2_args = array(
              'theme_location' => 'footer_2',
              'menu_class'     => 'footer-links',
              'container'      => false,
              'fallback_cb'    => false,
            );
            if ( $footer_menu_2 ) {
              $menu_2_args['menu'] = $footer_menu_2;
            }
            wp_nav_menu( $menu_2_args );
          ?>
        </div>

        <!-- Col 4 — Contact Us -->
        <div class="col-lg-4 col-md-6">
          <h4 class="footer-col__title"><?php echo esc_html( $footer_contact_title ); ?></h4>
          <?php if ( $footer_contact_info ) : ?>
            <ul class="footer-contact">
              <?php foreach ( $footer_contact_info as $contact ) : ?>
                <li>
                  <?php if ( $contact['icon'] ) echo $contact['icon']; ?>
                  <?php if ( $contact['link'] ) : ?>
                    <a href="<?php echo esc_attr( $contact['link'] ); ?>"><?php echo esc_html( $contact['text'] ); ?></a>
                  <?php else: ?>
                    <span><?php echo esc_html( $contact['text'] ); ?></span>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>

      </div>
    </div>

    <!-- Bottom bar -->
    <div class="footer-bottom">
      <?php echo wp_kses_post( $footer_copyright ); ?>
    </div>
  </footer>
  <!-- ====== END FOOTER ====== -->

<?php wp_footer(); ?>
</body>
</html>

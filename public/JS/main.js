window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".custom-navbar");
    if (window.scrollY > 50) {
        navbar?.classList.add("scrolled");
    } else {
        navbar?.classList.remove("scrolled");
    }
});

function loadComponent(id, file, callback) {
    fetch(file)
        .then((res) => res.text())
        .then((html) => {
            document.getElementById(id).innerHTML = html;
            if (callback) callback(); // Run callback after component loads
        })
        .catch((err) => console.error(`Error loading ${file}:`, err));
}

// Load navbar and highlight active link AFTER it's injected
// loadComponent("navbar", "Components/navbar.html", highlightActiveLink);
// loadComponent("newsletter", "Components/newsletter.html");
// loadComponent("footer", "Components/footer.html");
// loadComponent("modal", "Components/modal.html");

function highlightActiveLink() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
    const servicesDropdown = document.getElementById("servicesDropdown");

    // Remove active class from all nav links (including dropdown toggles)
    navLinks.forEach((link) => {
        link.classList.remove("active");
    });

    // Normalize current path (remove trailing slash, handle empty as '/')
    const normalizePath = (path) => {
        if (!path || path === '') return '/';
        return path.replace(/\/$/, '') || '/';
    };

    const currentPathNormalized = normalizePath(currentPath);

    // Check if we're on a services page
    const isServicesPage = currentPath.startsWith('/service') || currentPath === '/services';

    // Handle Services dropdown separately
    if (servicesDropdown) {
        if (isServicesPage) {
            servicesDropdown.classList.add("active");
        }
    }

    // Check each nav link
    navLinks.forEach((link) => {
        // Skip dropdown toggles - they're handled separately above
        if (link.classList.contains("dropdown-toggle")) {
            return;
        }

        const href = link.getAttribute("href");
        if (href) {
            // Extract pathname from href (handles both relative and absolute URLs)
            let linkPath = '';
            try {
                // Try to parse as URL (handles absolute URLs)
                const url = new URL(href, window.location.origin);
                linkPath = url.pathname;
            } catch (e) {
                // If parsing fails, assume it's a relative path
                linkPath = href.split('?')[0].split('#')[0]; // Remove query and hash
            }

            linkPath = normalizePath(linkPath);

            // Special handling for home route - both / and /home should match
            const isHomeLink = linkPath === '/' || linkPath === '/home';
            const isCurrentHome = currentPathNormalized === '/' || currentPathNormalized === '/home';

            if (isHomeLink && isCurrentHome) {
                link.classList.add("active");
            } else if (linkPath === currentPathNormalized) {
            link.classList.add("active");
            }
        }
    });
}

document.getElementById("currencyBtn")?.addEventListener("click", function () {
    window.open("https://www.xe.com/", "_blank");
});

document.getElementById("unitBtn")?.addEventListener("click", function () {
    window.open(
        "https://www.physlink.com/Reference/UnitConversion.cfm",
        "_blank"
    );
});

// FAQ accordion logic (add to JS/main.js or at page end)
// document.querySelectorAll(".faq-question").forEach((btn) => {
//   btn.addEventListener("click", function () {
//     const item = btn.closest(".faq-item");
//     const list = item.parentElement;
//     // Collapse all
//     list.querySelectorAll(".faq-item").forEach((i) => {
//       i.classList.remove("active");
//       i.querySelector(".faq-answer").classList.remove("show");
//       i.querySelector(".faq-toggle-icon").textContent = "+";
//     });
//     // Expand clicked
//     item.classList.add("active");
//     item.querySelector(".faq-answer").classList.add("show");
//     item.querySelector(".faq-toggle-icon").textContent = "–";
//   });
// });

document.querySelectorAll(".faq-question")?.forEach((btn) => {
    btn.addEventListener("click", function () {
        const item = btn.closest(".faq-item");
        const list = item.parentElement;

        const isActive = item.classList.contains("active");

        // Collapse all first
        list.querySelectorAll(".faq-item").forEach((i) => {
            i.classList.remove("active");
            i.querySelector(".faq-answer").classList.remove("show");
            i.querySelector(".faq-toggle-icon").textContent = "+";
        });

        // If the clicked one was not active, expand it
        if (!isActive) {
            item.classList.add("active");
            item.querySelector(".faq-answer").classList.add("show");
            item.querySelector(".faq-toggle-icon").textContent = "–";
        }
    });
});

document.querySelectorAll(".career-position-toggle")?.forEach((btn) => {
    btn.addEventListener("click", function () {
        const card = btn.closest(".career-position-card");
        const list = card.parentElement;

        const isActive = card.classList.contains("active");

        // Collapse all
        list.querySelectorAll(".career-position-card").forEach((i) => {
            i.classList.remove("active");
            i.querySelector(".career-position-details").classList.remove(
                "show"
            );
            i.querySelector(".career-toggle-icon").textContent =
                "chevron_right";
            i.querySelector(".career-position-toggle").classList.remove(
                "career-toggle-active"
            );
        });

        // If the clicked one was not active, expand it
        if (!isActive) {
            card.classList.add("active");
            card.querySelector(".career-position-details").classList.add(
                "show"
            );
            btn.classList.add("career-toggle-active");
            card.querySelector(".career-toggle-icon").textContent =
                "expand_more";
        }
    });
});

document?.getElementById("openQuoteModal")?.addEventListener("click", () => {
    const modalEl = document.getElementById("quoteModal");
    const myModal = new bootstrap.Modal(modalEl);
    myModal?.show();
});

document.addEventListener("DOMContentLoaded", function () {
    // Highlight active navigation link
    highlightActiveLink();

    // Mobile menu and dropdown handler
    let mobileMenuInitialized = false;

    function closeNavbar() {
        const navbarCollapse = document.getElementById("navbarContent");
        const navbarToggler = document.querySelector(".navbar-toggler");

        if (navbarCollapse) {
            // Try Bootstrap's collapse API first
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
            if (bsCollapse) {
                bsCollapse.hide();
            } else {
                // Fallback: manually close
                navbarCollapse.classList.remove("show");
            }
            if (navbarToggler) {
                navbarToggler.setAttribute("aria-expanded", "false");
            }
        }
    }

    // Manual services dropdown - use event delegation that ALWAYS works
    // This runs immediately and works on ALL pages
    (function () {
        // Remove Bootstrap's data attribute immediately on mobile - do this proactively
        function removeBootstrapAttr() {
            const servicesDropdown = document.getElementById("servicesDropdown");
            if (servicesDropdown && window.innerWidth <= 1199.98) {
                servicesDropdown.removeAttribute("data-bs-toggle");
            }
        }

        // Remove it multiple times to ensure it's gone
        removeBootstrapAttr();
        setTimeout(removeBootstrapAttr, 50);
        setTimeout(removeBootstrapAttr, 200);

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', removeBootstrapAttr);
        }
        window.addEventListener('load', removeBootstrapAttr);

        // Also remove on resize if switching to mobile
        window.addEventListener('resize', function () {
            if (window.innerWidth <= 1199.98) {
                removeBootstrapAttr();
            }
        });

        // Global click handler for services dropdown - works everywhere
        document.addEventListener("click", function (e) {
            const target = e.target;
            const servicesDropdown = document.getElementById("servicesDropdown");

            if (!servicesDropdown) return;

            // Check if click is on the services dropdown link
            const clickedOnServices = target === servicesDropdown ||
                (target.closest && target.closest("#servicesDropdown") === servicesDropdown) ||
                servicesDropdown.contains(target);

            if (!clickedOnServices) return;

            const isMobile = window.innerWidth <= 1199.98;
            if (!isMobile) return; // Let Bootstrap handle desktop

            const dropdownMenu = servicesDropdown.closest(".dropdown")?.querySelector(".dropdown-menu");
            if (!dropdownMenu) return;

            // Remove Bootstrap's data attribute immediately (in case it was re-added)
            servicesDropdown.removeAttribute("data-bs-toggle");

            // Prevent default and stop propagation - do this FIRST
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();

            // Toggle dropdown manually
            const isOpen = dropdownMenu.classList.contains("show");

            if (isOpen) {
                dropdownMenu.classList.remove("show");
                servicesDropdown.classList.remove("active");
                servicesDropdown.setAttribute("aria-expanded", "false");
            } else {
                dropdownMenu.classList.add("show");
                servicesDropdown.classList.add("active");
                servicesDropdown.setAttribute("aria-expanded", "true");
            }
        }, true); // Capture phase - runs BEFORE Bootstrap

        // Close dropdown when clicking outside
        document.addEventListener("click", function (e) {
            const servicesDropdown = document.getElementById("servicesDropdown");
            if (!servicesDropdown) return;

            const isMobile = window.innerWidth <= 1199.98;
            if (!isMobile) return;

            const dropdown = servicesDropdown.closest(".dropdown");
            const dropdownMenu = dropdown?.querySelector(".dropdown-menu");

            if (dropdown && dropdownMenu && dropdownMenu.classList.contains("show")) {
                if (!dropdown.contains(e.target)) {
                    dropdownMenu.classList.remove("show");
                    servicesDropdown.classList.remove("active");
                    servicesDropdown.setAttribute("aria-expanded", "false");
                }
            }
        });
    })();

    function initMobileMenu() {
        const navbarCollapse = document.getElementById("navbarContent");
        const navbarToggler = document.querySelector(".navbar-toggler");

        if (!navbarCollapse || !navbarToggler) {
            return;
        }

        const isMobile = window.innerWidth <= 1199.98;

        if (isMobile && !mobileMenuInitialized) {
            mobileMenuInitialized = true;

            // Close navbar collapse when clicking on nav links (except dropdown toggle)
            const navLinks = document.querySelectorAll(".navbar-nav .nav-link:not(.dropdown-toggle), .navbar-nav .dropdown-item");
            navLinks.forEach(link => {
                link.addEventListener("click", function () {
                    closeNavbar();
                });
            });
        }
    }

    // Initialize mobile menu
    initMobileMenu();

    // Re-initialize on window resize (reset flag when switching between mobile/desktop)
    let resizeTimer;
    let wasMobile = window.innerWidth <= 1199.98;
    window.addEventListener("resize", function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            const isMobile = window.innerWidth <= 1199.98;
            if (wasMobile !== isMobile) {
                mobileMenuInitialized = false;
                initMobileMenu();
                wasMobile = isMobile;
            }
        }, 250);
});

    // Handle close button click
    const closeBtn = document.querySelector(".navbar-close-btn");
    if (closeBtn) {
        closeBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            closeNavbar();
        });
    }

    // Listen to Bootstrap collapse events to toggle hamburger visibility
    const navbarCollapse = document.getElementById("navbarContent");
    const navbar = document.querySelector(".custom-navbar");
    const navbarToggler = document.querySelector(".navbar-toggler");

    if (navbarCollapse && navbar && navbarToggler) {
        // Ensure hamburger button works - add fallback if Bootstrap doesn't
        navbarToggler.addEventListener("click", function () {
            setTimeout(function () {
                // Check if menu opened, if not, force it
                if (!navbarCollapse.classList.contains("show")) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                    if (bsCollapse) {
                        bsCollapse.show();
                    } else {
                        navbarCollapse.classList.add("show");
                    }
                }
            }, 50);
        });

        // Control background timing with menu animation
        navbarCollapse.addEventListener('hiding.bs.collapse', function () {
            // Menu is starting to close - keep background visible
            navbar.classList.add("menu-closing");
            navbar.classList.remove("menu-open");
        });

        navbarCollapse.addEventListener('hidden.bs.collapse', function () {
            navbar.classList.remove("menu-open");
            document.body.classList.remove("mobile-menu-open");
            // Wait for menu items to fully disappear before removing background
            // Bootstrap collapse animation is ~350ms, wait a bit longer to ensure items are gone
            setTimeout(function() {
                navbar.classList.remove("menu-closing");
            }, 400); // Wait 400ms after menu is hidden to ensure items are gone
        });

        navbarCollapse.addEventListener('showing.bs.collapse', function () {
            // Menu is starting to open - show background immediately
            navbar.classList.remove("menu-closing");
            navbar.classList.add("menu-opening");
        });

        navbarCollapse.addEventListener('shown.bs.collapse', function () {
            navbar.classList.add("menu-open");
            navbar.classList.remove("menu-opening");
            document.body.classList.add("mobile-menu-open");
        });
    }
});

// Ensure breadcrumb Home link works on mobile - more robust approach
document.addEventListener("DOMContentLoaded", function () {
    function makeBreadcrumbClickable() {
        // Find all breadcrumb links in hero section (not active ones)
        const allBreadcrumbLinks = document.querySelectorAll('.hero-section .breadcrumb-item:not(.active) a');

        allBreadcrumbLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (!href) return;

            // Check if it's a home link (route('home') typically generates '/' or '/home')
            const isHomeLink = href === '/' || href === '/home' || href.includes('home') || href.endsWith('/');

            if (isHomeLink) {
                // Force pointer events and styling (z-index below navbar which is 1001-1002)
                link.style.pointerEvents = 'auto';
                link.style.cursor = 'pointer';
                link.style.zIndex = '20';
                link.style.position = 'relative';
                link.style.display = 'inline-block';

                // Remove any existing event listeners by cloning
                const newLink = link.cloneNode(true);
                link.parentNode.replaceChild(newLink, link);

                // Add touch handler for mobile (fires before click)
                newLink.addEventListener('touchstart', function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    const targetHref = this.getAttribute('href');
                    if (targetHref) {
                        window.location.href = targetHref;
                    }
                }, { passive: false });

                // Add click handler as fallback
                newLink.addEventListener('click', function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    const targetHref = this.getAttribute('href');
                    if (targetHref) {
                        window.location.href = targetHref;
                    }
                }, { passive: false });
            }
        });
    }

    // Run immediately
    makeBreadcrumbClickable();

    // Also run after a short delay to catch dynamically loaded content
    setTimeout(makeBreadcrumbClickable, 100);
});

// Tracking button functionality - wrapped to prevent redeclaration
(function () {
    const trackingBtn = document?.querySelector(".tracking-btn");
    if (!trackingBtn) return; // Exit if tracking button doesn't exist

    const btnText = trackingBtn?.querySelector(".btn-text");
    const btnArrow = trackingBtn?.querySelector(".btn-arrow");
    const btnLoader = trackingBtn?.querySelector(".btn-loader");
const resultBox = document?.getElementById("tracking-result");
const errorBox = document?.querySelector(".tracking-error");

    trackingBtn.addEventListener("click", async () => {
        const type = document.querySelector(".tracking-select")?.value;
        const text = document.querySelector(".tracking-input")?.value.trim();

    // Reset messages
        if (resultBox) resultBox.innerHTML = "";
        if (errorBox) errorBox.style.display = "none";

    if (!type || !text) {
            if (errorBox) {
        errorBox.style.display = "block";
        errorBox.innerHTML =
            "Please select a service type and enter a tracking number.";
            }
        return;
    }

    // Show loader in button
        if (btnArrow) btnArrow.style.display = "none";
        if (btnLoader) btnLoader.style.display = "inline-block";
        trackingBtn.disabled = true;

    try {
            // Use Laravel backend proxy to bypass CORS issues
        const response = await fetch(
                "/api/track-shipment",
            {
                method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || "",
                        "Accept": "application/json"
                    },
                body: JSON.stringify({
                    count: 10,
                    start_index: 0,
                    text: text,
                    type: type,
                }),
            }
        );

            if (!response.ok) {
                const errorText = await response.text();
                console.error("Response not OK:", response.status, errorText);
                throw new Error(`Network response was not ok: ${response.status} - ${errorText}`);
            }

        const data = await response.json();
            if (resultBox) {
                // Parse and display tracking data in a nice format
                if (data && data.d && Array.isArray(data.d) && data.d.length > 0) {
                    let html = '<div class="tracking-results-container mt-4">';

                    data.d.forEach((shipment, index) => {
                        html += `
                            <div class="tracking-card card mb-4 shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="material-icons me-2">local_shipping</i> Tracking Details #${index + 1}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="tracking-info-item">
                                                <span class="tracking-label"><i class="material-icons me-1">confirmation_number</i> Booking Reference:</span>
                                                <span class="tracking-value">${shipment.Booking_Ref || 'N/A'}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tracking-info-item">
                                                <span class="tracking-label"><i class="material-icons me-1">category</i> Booking Type:</span>
                                                <span class="tracking-value">${shipment.Booking_Type || 'N/A'}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tracking-info-item">
                                                <span class="tracking-label"><i class="material-icons me-1">calendar_today</i> Booking Date:</span>
                                                <span class="tracking-value">${shipment.Booking_Date || 'N/A'}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tracking-info-item">
                                                <span class="tracking-label"><i class="material-icons me-1">receipt</i> BOL/AWB Reference:</span>
                                                <span class="tracking-value">${shipment.BOL_AWB_Ref || 'N/A'}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tracking-info-item">
                                                <span class="tracking-label"><i class="material-icons me-1">flight_takeoff</i> Origin:</span>
                                                <span class="tracking-value">${shipment.Origin || 'N/A'}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tracking-info-item">
                                                <span class="tracking-label"><i class="material-icons me-1">flight_land</i> Destination:</span>
                                                <span class="tracking-value">${shipment.Destination || 'N/A'}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tracking-info-item">
                                                <span class="tracking-label"><i class="material-icons me-1">directions_boat</i> Vessel/Vehicle:</span>
                                                <span class="tracking-value">${shipment.Book_Veh || 'N/A'}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tracking-info-item">
                                                <span class="tracking-label"><i class="material-icons me-1">schedule</i> ETD (Estimated Departure):</span>
                                                <span class="tracking-value text-info">${shipment.ETD || 'N/A'}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tracking-info-item">
                                                <span class="tracking-label"><i class="material-icons me-1">event</i> ETA (Estimated Arrival):</span>
                                                <span class="tracking-value text-success">${shipment.ETA || 'N/A'}</span>
                                            </div>
                                        </div>
                                        ${shipment.book_id ? `
                                        <div class="col-md-6">
                                            <div class="tracking-info-item">
                                                <span class="tracking-label"><i class="material-icons me-1">tag</i> Booking ID:</span>
                                                <span class="tracking-value">${shipment.book_id}</span>
                                            </div>
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    html += '</div>';
                    resultBox.innerHTML = html;
                } else {
                    resultBox.innerHTML = `
                        <div class="alert alert-info mt-4" role="alert">
                            <i class="material-icons me-2">info</i>
                            No tracking information found for the provided details. Please verify your tracking number and try again.
                        </div>
                    `;
                }
            }
    } catch (error) {
            console.error("Tracking API Error:", error);
            console.error("Error details:", {
                message: error.message,
                name: error.name,
                stack: error.stack
            });
            if (errorBox) {
                let errorMessage = "Failed to fetch tracking details. Please try again.";
                // Show more specific error if it's a CORS issue
                if (error.message.includes("CORS") || error.message.includes("Failed to fetch") || error.name === "TypeError") {
                    errorMessage = "CORS Error: The API server doesn't allow requests from this domain. Please contact the administrator.";
                }
        errorBox.style.display = "block";
                errorBox.innerHTML = errorMessage + "<br><small>Check browser console for details.</small>";
            }
    } finally {
        // Restore button state
            if (btnText) btnText.style.display = "inline";
            if (btnArrow) btnArrow.style.display = "inline";
            if (btnLoader) btnLoader.style.display = "none";
            trackingBtn.disabled = false;
    }
});
})();

// Custom File Upload Functionality
document.addEventListener("DOMContentLoaded", function () {
    const fileInputs = document.querySelectorAll(
        '.custom-file-upload input[type="file"]'
    );

    fileInputs.forEach((input) => {
        input.addEventListener("change", function () {
            const container = this.closest(".custom-file-upload");
            const fileNameSpan = container.querySelector(".file-name");
            const fileText = container.querySelector(".file-text");

            if (this.files && this.files[0]) {
                const fileName = this.files[0].name;
                const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2); // Size in MB

                // Update the display
                fileNameSpan.textContent = `${fileName} (${fileSize} MB)`;
                fileNameSpan.classList.remove("text-muted");
                fileText.textContent = "File Selected";
                container.classList.add("has-file");
            } else {
                // Reset if no file selected
                fileNameSpan.textContent = "No file selected";
                fileNameSpan.classList.add("text-muted");
                fileText.textContent = "Choose CV/Resume";
                container.classList.remove("has-file");
            }
        });
    });

    // Make blog cards clickable
    (function () {
        // Use event delegation to handle clicks on blog cards
        document.addEventListener('click', function (e) {
            // Find the closest blog card with data-blog-url attribute
            const blogCard = e.target.closest('.blog-card[data-blog-url]');

            if (blogCard) {
                // Don't navigate if clicking on the "Read More" link (let it handle its own click)
                if (e.target.closest('.readmore-btn')) {
                    return; // Let the link handle navigation
                }

                // Get the URL from data attribute
                const blogUrl = blogCard.getAttribute('data-blog-url');
                if (blogUrl) {
                    window.location.href = blogUrl;
                }
            }
        });
    })();
});

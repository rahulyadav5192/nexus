const testimonials = [
  {
    img: "assets/img/home/client.png",
    text: "It really saves me time and effort. Kargon is exactly what our business has been lacking.",
    name: "KRISTIN DIXON",
    role: "RELATIONS SPECIALIST",
  },
  {
    img: "assets/img/home/client1.png",
    text: "This service has completely transformed our logistics. Highly recommended!",
    name: "JAMES CARTER",
    role: "SUPPLY CHAIN MANAGER",
  },
  {
    img: "assets/img/home/client2.png",
    text: "We saw immediate results after using Kargon. Fantastic support and smooth operations.",
    name: "SOPHIA LEE",
    role: "OPERATIONS HEAD",
  },
];

// Initialize testimonial slider only if elements exist
const imgEl = document.getElementById("testimonial-img");
const textEl = document.getElementById("testimonial-text");
const nameEl = document.getElementById("testimonial-name");
const roleEl = document.getElementById("testimonial-role");
const prevBtn = document.getElementById("prev-btn");
const nextBtn = document.getElementById("next-btn");

if (imgEl && textEl && nameEl && roleEl && prevBtn && nextBtn) {
  let current = 0;

  function showTestimonial(index) {
    const t = testimonials[index];
    imgEl.src = t.img;
    textEl.textContent = t.text;
    nameEl.textContent = t.name;
    roleEl.textContent = t.role;
  }

  prevBtn.addEventListener("click", () => {
    current = (current - 1 + testimonials.length) % testimonials.length;
    showTestimonial(current);
  });

  nextBtn.addEventListener("click", () => {
    current = (current + 1) % testimonials.length;
    showTestimonial(current);
  });

  // Initialize
  showTestimonial(current);
}

// Initialize services slider only if elements exist
const scrollContainer = document.querySelector(".services-scroll");
const dots = document.querySelectorAll(".swipper-dots .dot");

if (scrollContainer && dots.length > 0) {
  let currentIndex = 0;

  // Function to calculate card width dynamically
  function getCardWidth() {
    const isMobile = window.innerWidth <= 767;
    if (isMobile) {
      // On mobile, card is full viewport width minus container padding (15px each side) + gap
      return window.innerWidth - 30 + 15; // viewport - padding + margin-right gap
    }
    // On desktop/tablet, use first card wrapper's width + gap
    const firstCardWrapper = scrollContainer.querySelector('div');
    if (firstCardWrapper) {
      const cardRect = firstCardWrapper.getBoundingClientRect();
      return cardRect.width + 20; // card width + gap
    }
    return 460; // fallback
  }

  function updateDots(index) {
    dots.forEach((dot, i) => {
      dot.classList.toggle("active", i === index);
    });
  }

  function autoScroll() {
    currentIndex++;
    if (currentIndex >= dots.length) {
      currentIndex = 0;
      scrollContainer.scrollTo({ left: 0, behavior: "smooth" });
    } else {
      const cardWidth = getCardWidth();
      scrollContainer.scrollBy({ left: cardWidth, behavior: "smooth" });
    }
    updateDots(currentIndex);
  }

  // Auto scroll every 5s
  let autoScrollInterval = setInterval(autoScroll, 5000);

  // Dot click → go to that card
  dots.forEach((dot, index) => {
    dot.addEventListener("click", () => {
      clearInterval(autoScrollInterval); // pause auto
      currentIndex = index;
      const cardWidth = getCardWidth();
      scrollContainer.scrollTo({ left: cardWidth * index, behavior: "smooth" });
      updateDots(currentIndex);
      autoScrollInterval = setInterval(autoScroll, 5000); // resume auto
    });
  });

  // Update on window resize
  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      // Recalculate and adjust scroll position if needed
      const cardWidth = getCardWidth();
      scrollContainer.scrollTo({ left: cardWidth * currentIndex, behavior: "smooth" });
    }, 250);
  });
}

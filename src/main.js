// src/main.js

// ===== ENV VALUES =====
const EMAILJS_PUBLIC_KEY  = import.meta.env.VITE_EMAILJS_PUBLIC_KEY;
const EMAILJS_SERVICE_ID = import.meta.env.VITE_EMAILJS_SERVICE_ID;
const EMAILJS_TEMPLATE_ID = import.meta.env.VITE_EMAILJS_TEMPLATE_ID;
const WHATSAPP_PHONE = import.meta.env.VITE_WHATSAPP_PHONE;

// ===== INIT EMAILJS (same as before) =====
emailjs.init(EMAILJS_PUBLIC_KEY);

// ===== WHATSAPP (same logic) =====
window.openWhatsApp = function () {
  const message = encodeURIComponent(
    "Hi Samuel, I would like to get in touch with you."
  );

  const isMobile = /iPhone|Android|webOS|BlackBerry|IEMobile|Opera Mini/i.test(
    navigator.userAgent
  );

  const baseUrl = isMobile
    ? "https://wa.me/"
    : "https://web.whatsapp.com/send?phone=";

  const fullUrl = isMobile
    ? `${baseUrl}${WHATSAPP_PHONE}?text=${message}`
    : `${baseUrl}${WHATSAPP_PHONE}&text=${message}`;

  window.open(fullUrl, "_blank");
};

// ===== FORM HANDLER (same sendForm flow) =====
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("contactForm");
  if (!form) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    emailjs
      .sendForm(
        EMAILJS_SERVICE_ID,
        EMAILJS_TEMPLATE_ID,
        this
      )
      .then(() => {
        Swal.fire("Message Sent!", "I'll get back to you shortly.", "success");
        this.reset();
      })
      .catch(() => {
        Swal.fire("Oops!", "Something went wrong. Try again.", "error");
      });
  });
});

import emailjs from "emailjs-com";
import Swal from "sweetalert2";

emailjs.init(import.meta.env.VITE_EMAILJS_PUBLIC_KEY);

window.openWhatsApp = function () {
  const msg = encodeURIComponent(import.meta.env.VITE_WHATSAPP_MESSAGE);
  window.open(
    `https://wa.me/${import.meta.env.VITE_WHATSAPP_PHONE}?text=${msg}`,
    "_blank"
  );
};

document.getElementById("contactForm").addEventListener("submit", e => {
  e.preventDefault();

  emailjs.sendForm(
    import.meta.env.VITE_EMAILJS_SERVICE_ID,
    import.meta.env.VITE_EMAILJS_TEMPLATE_ID,
    e.target
  ).then(() => {
    Swal.fire("Message Sent", "I’ll respond shortly.", "success");
    e.target.reset();
  }).catch(() => {
    Swal.fire("Error", "Failed to send message.", "error");
  });
});

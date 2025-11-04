// Fonction pour afficher une notification temporaire
function showNotification(message, type = "info") {
  const notif = document.createElement("div");
  notif.className = `notif ${type}`;
  notif.textContent = message;
  document.body.appendChild(notif);
  setTimeout(() => notif.remove(), 2500);
}

// Gestion du changement de statut des rendez-vous
document.addEventListener("DOMContentLoaded", () => {
  const statusButtons = document.querySelectorAll(".statut");

  statusButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const current = btn.textContent.trim().toLowerCase();

      if (current === "confirmé") {
        btn.textContent = "En attente";
        btn.classList.remove("confirmé");
        btn.classList.add("en attente");
        showNotification("Le rendez-vous est maintenant en attente.", "warning");
      } else {
        btn.textContent = "Confirmé";
        btn.classList.remove("en attente");
        btn.classList.add("confirmé");
        showNotification("Le rendez-vous a été confirmé avec succès ✅", "success");
      }
    });
  });
});

function showToast(message, type = "success") {
  // Create the toast element
  const toast = document.createElement("div");
  toast.classList.add("toast", type);
  toast.innerText = message;

  // Append to the container
  const container = document.getElementById("toast-container");
  container.appendChild(toast);

  // Remove toast after 4 seconds
  setTimeout(() => {
    toast.remove();
  }, 4000);
}

function showPopup(message, type) {
  const popup = document.getElementById('popup');
  popup.textContent = message;
  popup.className = 'popup ' + type + ' show';
  setTimeout(() => {
    popup.className = 'popup ' + type;
  }, 3000);
}
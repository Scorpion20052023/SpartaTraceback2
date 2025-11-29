// user.js
document.addEventListener("DOMContentLoaded", () => {
  // Replace all spans with id="userName"
  document.querySelectorAll('#userName').forEach(el => {
    el.textContent = USERNAME;
  });

  // Replace all spans with id="telNo"
  document.querySelectorAll('#telNo').forEach(el => {
    el.textContent = PHONE;
  });

  // Replace all spans with id="emailAddress"
  document.querySelectorAll('#emailAddress').forEach(el => {
    el.textContent = EMAIL;
  });
});
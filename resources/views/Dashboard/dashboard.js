const sidebar = document.querySelector('.sidebar');
const mainContent = document.querySelector('.main-content');
document.querySelector('.sidebar-toggle').addEventListener('click', () => {
  sidebar.classList.toggle('collapsed');
  mainContent.classList.toggle('collapsed');
});

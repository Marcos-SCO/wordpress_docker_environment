function setAdminBarOffset() {
  const adminBar = document.getElementById('wpadminbar');
  if (!adminBar) return;
  
  document.documentElement.style.setProperty(
    '--admin-bar-height',
    adminBar ? `${adminBar.offsetHeight}px` : '0px'
  );
}

window.addEventListener('load', setAdminBarOffset);
window.addEventListener('resize', setAdminBarOffset);
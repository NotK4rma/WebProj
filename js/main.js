document.getElementById("lgin").addEventListener("click", function () {
    window.location.href = "../html/login.html";
  });


  const imgContainers = document.querySelectorAll('.four .img-container');
  imgContainers.forEach(imgContainer => {
    imgContainer.addEventListener('mouseover', function () {
      document.querySelector('.four .shadowBg').style.backgroundColor = 'rgba(0, 0, 0, 0.4)';
    });
  
    imgContainer.addEventListener('mouseout', function () {
      document.querySelector('.four .shadowBg').style.backgroundColor = ''; 
    });
  });


  const article = document.querySelectorAll('.article-1');
  article.forEach(article => {
    article.addEventListener('mouseover', function () {
      document.querySelector('.article-space .shadowBg').style.backgroundColor = 'rgba(0, 0, 0, 0.4)';
    });
  
    article.addEventListener('mouseout', function () {
      document.querySelector('.article-space .shadowBg').style.backgroundColor = ''; 
    });
  });
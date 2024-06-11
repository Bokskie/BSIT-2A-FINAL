let slideIndex = {
    tab4: 1,
    tab5: 1,
    tab6: 1,
    tab7: 1,
    tab8: 1
  };
  
  showSlides(slideIndex.tab4, 'tab4');
  showSlides(slideIndex.tab5, 'tab5');
  showSlides(slideIndex.tab6, 'tab6');
  showSlides(slideIndex.tab7, 'tab7');
  showSlides(slideIndex.tab8, 'tab8');
  
  function plusSlides(n, tabId) {
    showSlides(slideIndex[tabId] += n, tabId);
  }
  
  function currentSlide(n, tabId) {
    showSlides(slideIndex[tabId] = n, tabId);
  }
  
  function showSlides(n, tabId) {
    let i;
    let slides = document.getElementById(tabId).getElementsByClassName("mySlides");
    let dots = document.getElementById(tabId).getElementsByClassName("dot");
    if (n > slides.length) {slideIndex[tabId] = 1}    
    if (n < 1) {slideIndex[tabId] = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex[tabId]-1].style.display = "block";  
    dots[slideIndex[tabId]-1].className += " active";
  }
  
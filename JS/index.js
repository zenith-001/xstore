document.body.onscroll = function () {
    x = (window.scrollY / document.body.scrollHeight) * 100;
    console.log(x + "%");
    console.log(x + "%");
  };
  let carousel = document.querySelector(".carousel");
  let btns = document.querySelectorAll(".wrapper  i");
  let carouselChildren = [...carousel.children];
  let wrapper = document.querySelector(".wrapper ");

  //getting card width
  let cardWidth = carousel.querySelector(".card").offsetWidth;
  let isDragging = false,
    startX,
    startScrollLeft,
    isAutoPlay = true,
    timeoutId;

  //getting number of cards can fit in carousel at once
  let cardsPerView = Math.round(carousel.offsetWidth / cardWidth);

  //inserting copied few last cards to beggining of carousel for infinite scrolling
  carouselChildren
    .slice(-cardsPerView)
    .reverse()
    .forEach((card) => {
      carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
    });

  //inserting copied few first cards to end of the carousel for infinite scrolling
  carouselChildren.slice(0, cardsPerView).forEach((card) => {
    carousel.insertAdjacentHTML("beforeend", card.outerHTML);
  });

  btns.forEach((btn) => {
    btn.addEventListener("click", () => {
      //if the clicked button id is left scrolling carousel towards left by card width else towards right by card width
      carousel.scrollLeft += btn.id == "left" ? -cardWidth : cardWidth;
    });
  });

  let dragStart = (e) => {
    isDragging = true;

    carousel.classList.add("dragging");

    //recording initial cursor and scroll position
    startX = e.pageX;
    startScrollLeft = carousel.scrollLeft;
  };

  let dragging = (e) => {
    //returning here if the isDragging value is false
    if (!isDragging) return;

    //scrolling carousel according to mouse cursor
    carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
  };

  let dragStop = () => {
    isDragging = false;

    carousel.classList.remove("dragging");
  };

  let infiniteScroll = () => {
    //if the carousel is at begining, scroll to end
    //else carousel at end , scroll to beginning
    if (carousel.scrollLeft === 0) {
      carousel.classList.add("no-transition");
      carousel.scrollLeft = carousel.scrollWidth - 2 * carousel.offsetWidth;
      carousel.classList.remove("no-transition");
    } else if (
      Math.ceil(carousel.scrollLeft) ===
      carousel.scrollWidth - carousel.offsetWidth
    ) {
      carousel.classList.add("no-transition");
      carousel.scrollLeft = carousel.offsetWidth;
      carousel.classList.remove("no-transition");
    }
  };
  carousel.addEventListener("mousedown", dragStart);
  carousel.addEventListener("mousemove", dragging);
  document.addEventListener("mouseup", dragStop);
  carousel.addEventListener("scroll", infiniteScroll);
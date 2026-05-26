const images = document.querySelectorAll(".gallery-wrapper img");
const lightbox = document.querySelector(".lightbox");
const lightboxMain = document.querySelector(".lightbox-main img");
const lightboxTint = document.querySelector(".lightbox .background-tint");
const lightboxClose = document.querySelector(".close-button");
const lightboxReel = document.querySelector(".lightbox-reel");
const btnNext = document.querySelector(".lightbox-next");
const btnPrev = document.querySelector(".lightbox-prev");
const body = document.querySelector("body");

let currentIndex = 0;

console.log(images.length);

let imgUrls = [];

images.forEach((img) => {
  imgUrls.push(img.dataset.full);

  img.addEventListener("mouseup", () => {
    open_image(img.dataset.full);
  });

  const tile = document.createElement("img");
  tile.src = img.dataset.full;
  tile.classList.add("reel-thumb");
  tile.addEventListener("mouseup", () => {
    open_image(img.dataset.full);
  });
  lightboxReel.appendChild(tile);
});

function open_image(url) {
  if (!imgUrls.includes(url)) {
    console.log("ello");
    lightbox.classList.add("hidden");
    body.style.overflow = "";
    return;
  }

  currentIndex = imgUrls.indexOf(url);
  lightboxMain.src = url;
  lightboxTint.style.backgroundImage = `url(${url})`;
  lightbox.classList.remove("hidden");
  body.style.overflow = "hidden";

  const tiles = lightboxReel.querySelectorAll(".reel-thumb");
  tiles.forEach((t) => t.classList.remove("active"));
  if (tiles[currentIndex]) {
    const activeTile = tiles[currentIndex];
    activeTile.classList.add("active");

    const scrollPos =
      activeTile.offsetLeft +
      activeTile.offsetWidth / 2 -
      lightboxReel.offsetWidth / 2;

    lightboxReel.scrollTo({
      left: scrollPos,
      behavior: "smooth",
    });
  }
}

function change_image(dir) {
  currentIndex += dir;
  if (currentIndex < 0) currentIndex = imgUrls.length - 1;
  if (currentIndex >= imgUrls.length) currentIndex = 0;
  open_image(imgUrls[currentIndex]);
}

lightboxClose.addEventListener("mouseup", () => {
  open_image();
});

btnNext.addEventListener("mouseup", () => change_image(1));
btnPrev.addEventListener("mouseup", () => change_image(-1));

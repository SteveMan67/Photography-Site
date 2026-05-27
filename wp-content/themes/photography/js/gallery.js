const images = document.querySelectorAll(".gallery-wrapper img");
const lightbox = document.querySelector(".lightbox");
const lightboxTitle = document.querySelector(".lightbox .title");
const lightboxDate = document.querySelector(".lightbox .date-taken");
const description = document.querySelector(".lightbox .description");
const lightboxMain = document.querySelector(".lightbox-main img");
const lightboxTint = document.querySelector(".lightbox .background-tint");
const lightboxClose = document.querySelector(".close-button");
const lightboxReel = document.querySelector(".lightbox-reel");
const btnNext = document.querySelector(".lightbox-next");
const btnPrev = document.querySelector(".lightbox-prev");
const body = document.querySelector("body");

let currentIndex = 0;

console.log(images.length);

let imgData = [];

images.forEach((img) => {
  const dataPoint = {};
  dataPoint.url = img.dataset.full;
  dataPoint.title = img.dataset.title;
  dataPoint.date = img.dataset.date;
  dataPoint.description = img.dataset.description;
  imgData.push(dataPoint);

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
  imageData = imgData.filter((f) => f.url === url);
  if (!imageData.length) {
    lightbox.classList.add("hidden");
    body.style.overflow = "";
    return;
  }

  currentPhoto = imageData[0];

  currentIndex = imgData.indexOf(currentPhoto);
  lightboxMain.src = url;
  lightboxTitle.innerText = currentPhoto.title;
  lightboxDate.innerText = currentPhoto.date;
  description.innerText = currentPhoto.description;

  const oldTint = lightbox.querySelector(".background-tint");
  const newTint = document.createElement("div");
  newTint.className = "background-tint";
  newTint.style.backgroundImage = `url(${url})`;
  newTint.style.opacity = 0;

  lightbox.insertBefore(newTint, lightbox.firstChild);

  requestAnimationFrame(() => {
    newTint.style.opacity = "0.4";
    if (oldTint) {
      oldTint.style.opacity = "0";
      setTimeout(() => oldTint.remove(), 500);
    }
  });

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
  if (currentIndex < 0) currentIndex = imgData.length - 1;
  if (currentIndex >= imgData.length) currentIndex = 0;
  open_image(imgData[currentIndex].url);
}

lightboxClose.addEventListener("mouseup", () => {
  open_image();
});

btnNext.addEventListener("mouseup", () => change_image(1));
btnPrev.addEventListener("mouseup", () => change_image(-1));

document.addEventListener("keyup", (e) => {
  if (lightbox.classList.contains("hidden")) return;
  if (e.key === "ArrowLeft") {
    e.stopImmediatePropagation();
    change_image(-1);
  } else if (e.key === "ArrowRight") {
    e.stopImmediatePropagation();
    change_image(1);
  } else if (e.key === "Escape") {
    e.stopPropagation();
    open_image();
  }
});

lightboxReel.addEventListener("wheel", (e) => {
  e.preventDefault();
  lightboxReel.scrollBy({
    left: e.deltaY * 4,
    behavior: "smooth",
  });
});

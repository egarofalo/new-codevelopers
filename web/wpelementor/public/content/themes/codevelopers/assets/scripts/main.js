import "bootstrap";
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

// Register ScrollTrigger gsap plugin
gsap.registerPlugin(ScrollTrigger);

jQuery(function () {
    animate_image_header();
});

function animate_image_header() {
    let imageHeader = document.querySelector(".site-header .image-header");

    // if image header element is null cancel parallax creation
    if (!imageHeader) {
        return;
    }

    // get parallax items
    let background = imageHeader.querySelector(".image-header__background");
    let title = imageHeader.querySelector(".image-header__title");

    // create parallax with gsap
    gsap.timeline()
        .from(background, {
            ease: "power1.out",
            y: -100,
            scrollTrigger: {
                scrub: true,
                trigger: document.body,
                start: "top top",
                end: "bottom top",
                endTrigger: background,
            },
        })
        .to(
            title,
            {
                ease: "power1.out",
                opacity: 0,
                scrollTrigger: {
                    scrub: true,
                    trigger: document.body,
                    start: "top top",
                    end: "bottom top",
                    endTrigger: title,
                },
            },
            0
        );
}

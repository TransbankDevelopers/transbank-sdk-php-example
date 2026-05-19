import hljs from "highlight.js";
import ClipboardJS from "clipboard";
import "highlight.js/styles/tokyo-night-dark.css";

function initializeHighlight() {
    hljs.configure({
        languages: ["php", "json", "html", "array"],
    });

    document.querySelectorAll("pre code").forEach((el) => {
        hljs.highlightElement(el);
    });
}

async function loadCardAnimation() {
    const { default: Card } = await import("card");
    await import("card/lib/card.css");
    window.Card = Card;
    document.dispatchEvent(new Event("card-loaded"));
}

document.addEventListener("DOMContentLoaded", function () {
    new ClipboardJS(".clipboard");
    initializeHighlight();

    if (document.querySelector(".card-wrapper")) {
        loadCardAnimation();
    }
});

document.addEventListener("livewire:init", () => {
    Livewire.on("snippet-response-updated", () => {
        setTimeout(() => {
            if (document.querySelector("pre code")) {
                initializeHighlight();
            }
        }, 100);
    });
});

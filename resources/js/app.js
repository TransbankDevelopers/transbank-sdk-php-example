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

document.addEventListener("DOMContentLoaded", function () {
    new ClipboardJS(".clipboard");
    initializeHighlight();
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

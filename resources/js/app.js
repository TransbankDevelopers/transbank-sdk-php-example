import hljs from "highlight.js";
import ClipboardJS from "clipboard";
import "highlight.js/styles/tokyo-night-dark.css";

document.addEventListener("DOMContentLoaded", function () {
    new ClipboardJS(".clipboard");

    hljs.configure({
        languages: ["php", "json", "html"],
    });

    document.querySelectorAll("pre code").forEach((el) => {
        hljs.highlightElement(el);
    });
});

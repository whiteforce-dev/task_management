document.addEventListener("DOMContentLoaded", (event) => {
  var dragSrcEl = null;

  function handleDragStart(e) {
    this.style.opacity = "0.1";
    this.style.border = "3px dashed #c4cad3";

    dragSrcEl = this;

    e.dataTransfer.effectAllowed = "move";
    e.dataTransfer.setData(
      "text/html",
      this.outerHTML.replace(
        `style="opacity: 0.1; border: 3px dashed rgb(196, 202, 211);"`,
        ""
      )
    );
  }

  function handleDragOver(e) {
    this.classList.add("task-hover");
    if (e.preventDefault) {
      e.preventDefault();
    }

    e.dataTransfer.dropEffect = "move";

    return false;
  }

  function handleDragEnter(e) {
    this.style.border = "2px dashed #ccc";
  }

  function handleDragLeave(e) {
    this.style.border = "2px dashed #cccccc00";
    this.classList.remove("task-hover");
  }

  function handleDrop(e) {
    this.style.border = "none";
    this.classList.remove("task-hover");

    if (dragSrcEl != this) {
      dragSrcEl.remove();
      console.log(parseInt(this.dataset.count), parseInt(dragSrcEl.dataset.id));
      this.innerHTML += e.dataTransfer.getData("text/html");
    }
    attachEvent();

    return false;
  }

  function handleDragEnd(e) {
    this.style.opacity = "1";
    this.style.border = 0;

    let items = document.querySelectorAll(".task");
    items.forEach(function (item) {
      item.classList.remove("task-hover");
    });
    attachEvent();
  }

  function attachEvent() {
    let items = document.querySelectorAll(".task");
    items.forEach(function (item) {
      item.removeEventListener("dragstart", () => {});
      item.parentElement.removeEventListener("dragenter", () => {});
      item.parentElement.removeEventListener("dragover", () => {});
      item.parentElement.removeEventListener("dragleave", () => {});
      item.parentElement.removeEventListener("drop", () => {});
      item.removeEventListener("dragend", () => {});
    });
    items.forEach(function (item) {
      item.addEventListener("dragstart", handleDragStart, false);
      item.parentElement.addEventListener("dragenter", handleDragEnter, false);
      item.parentElement.addEventListener("dragover", handleDragOver, false);
      item.parentElement.addEventListener("dragleave", handleDragLeave, false);
      item.parentElement.addEventListener("drop", handleDrop, false);
      item.addEventListener("dragend", handleDragEnd, false);
    });
  }
  attachEvent();
});

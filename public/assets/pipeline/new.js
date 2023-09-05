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
            console.log(this.dataset.count, dragSrcEl.dataset.id);
            updateCardStatus(dragSrcEl.dataset.id, this.dataset.count);
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
        let columns = document.querySelectorAll(".chromecolum");
        items.forEach(function (item) {
            item.removeEventListener("dragstart", () => {});
            item.removeEventListener("dragend", () => {});
        });
        columns.forEach(function (column) {
            column.removeEventListener("dragenter", () => {});
            column.removeEventListener("dragover", () => {});
            column.removeEventListener("dragleave", () => {});
            column.removeEventListener("drop", () => {});
        });
        items.forEach(function (item) {
            item.addEventListener("dragstart", handleDragStart, false);
            item.addEventListener("dragend", handleDragEnd, false);
        });
        columns.forEach(function (column) {
            column.addEventListener("dragenter", handleDragEnter, false);
            column.addEventListener("dragover", handleDragOver, false);
            column.addEventListener("dragleave", handleDragLeave, false);
            column.addEventListener("drop", handleDrop, false);
        });
    }
    attachEvent();
});

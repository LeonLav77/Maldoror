function removeAllChildNodes(parent) { // removes child nodes of the param element
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);

    }
}

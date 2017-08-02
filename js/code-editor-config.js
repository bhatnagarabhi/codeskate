function foo(items) {
    var x = "All this is syntax highlighted";
    return x;
}

var editor = ace.edit("editor");
editor.getSession().setUseSoftTabs(true);
editor.setTheme("ace/theme/monokai");
editor.getSession().setUseWrapMode(true);
editor.setShowPrintMargin(true);
editor.setHighlightActiveLine(true);
editor.getSession().setMode("ace/mode/javascript");
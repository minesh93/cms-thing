import ace from 'brace';
ace.define("ace/theme/claws",["require","exports","module","ace/lib/dom"], function(acequire, exports, module) {

exports.isDark = true;
exports.cssClass = "ace-claws";
exports.cssText = `.ace-claws .ace_gutter {
background: #1C252A;
color: #CED3DF
}
.ace-claws .ace_print-margin {
width: 1px;
background: #555651
}
.ace-claws {
background-color: #1C252A;
color: #CED3DF
}
.ace-claws .ace_cursor {
color: #F8F8F0
}

.ace-claws .ace_identifier {

}
.ace-claws .ace_marker-layer .ace_selection {
background: #49483E
}
.ace-claws.ace_multiselect .ace_selection.ace_start {
box-shadow: 0 0 3px 0px #272822;
}
.ace-claws .ace_marker-layer .ace_step {
background: rgb(102, 82, 0)
}
.ace-claws .ace_marker-layer .ace_bracket {
margin: -1px 0 0 -1px;
border: 1px solid #49483E
}
.ace-claws .ace_marker-layer .ace_active-line {
background: #263239
}
.ace-claws .ace_gutter-active-line {
background-color: #263239
}
.ace-claws .ace_marker-layer .ace_selected-word {
border: 1px solid #49483E
}
.ace-claws .ace_invisible {
color: #52524d
}
.ace-claws .ace_entity.ace_name.ace_tag,
.ace-claws .ace_keyword,
.ace-claws .ace_meta.ace_tag,
.ace-claws .ace_storage {
color: #F07178;
}
.ace-claws .ace_punctuation,
.ace-claws .ace_punctuation.ace_tag {
color: #89DDFF;
}
.ace-claws .ace_constant.ace_character,
.ace-claws .ace_constant.ace_language,
.ace-claws .ace_constant.ace_numeric,
.ace-claws .ace_constant.ace_other {
color: #F07178;
}
.ace-claws .ace_invalid {
color: #F8F8F0;
background-color: #F07178;
}
.ace-claws .ace_invalid.ace_deprecated {
color: #F8F8F0;
background-color: #F07178;
}
.ace-claws .ace_support.ace_constant,
.ace-claws .ace_support.ace_function {
color: #66D9EF
}
.ace-claws .ace_fold {
background-color: #F07178;
border-color: #CED3DF
}
.ace-claws .ace_storage.ace_type,
.ace-claws .ace_support.ace_class,
.ace-claws .ace_support.ace_type {
font-style: italic;
color: #66D9EF
}
.ace-claws .ace_entity.ace_name.ace_function,
.ace-claws .ace_entity.ace_other,
.ace-claws .ace_entity.ace_other.ace_attribute-name,
.ace-claws .ace_variable {
color: #F07178;
}
.ace-claws .ace_variable.ace_parameter {
font-style: italic;
color: #FD971F
}
.ace-claws .ace_string {
color: #E6DB74
}
.ace-claws .ace_comment {
color: #75715E
}
.ace-claws .ace_indent-guide {
background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAACCAYAAACZgbYnAAAAEklEQVQImWPQ0FD0ZXBzd/wPAAjVAoxeSgNeAAAAAElFTkSuQmCC) right repeat-y
}
.ace_dark .ace_gutter-cell.ace_info {
    background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAJFBMVEUAAAChoaGAgIAqKiq+vr6tra1ZWVmUlJSbm5s8PDxubm56enrdgzg3AAAAAXRSTlMAQObYZgAAAClJREFUeNpjYMAPdsMYHegyJZFQBlsUlMFVCWUYKkAZMxZAGdxlDMQBAG+TBP4B6RyJAAAAAElFTkSuQmCC");
}

`;

var dom = acequire("../lib/dom");
dom.importCssString(exports.cssText, exports.cssClass);
});

require('brace/mode/javascript');
require('brace/mode/php');
require('brace/mode/html');
require('brace/mode/css');
require('brace/mode/sass');
require('brace/mode/less');
require('brace/mode/typescript');
require('brace/mode/ruby');
require('brace/mode/vbscript');
require('brace/mode/csharp');
require('brace/mode/c_cpp');
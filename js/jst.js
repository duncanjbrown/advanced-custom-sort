this.JST = {"candidate_post": function(obj) {
obj || (obj = {});
var __t, __p = '', __e = _.escape;
with (obj) {
__p += '<div class="acs_option" rel="' +
((__t = ( candidate.id )) == null ? '' : __t) +
'">\n    <span class="cb"></span>\n    <span class="acs_title">' +
((__t = ( candidate.title )) == null ? '' : __t) +
'</span>\n</div>\n';

}
return __p
}};
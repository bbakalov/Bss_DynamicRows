define(
    [],
    function() {
        "use strict";
        var cache = [];
        return {
            get: function(addressKey) {
                if (cache[addressKey]) {
                    return cache[addressKey];
                }
                return false;
            },
            set: function(addressKey, data) {
                cache[addressKey] = data;
            }
        };
    }
);
var URLQueryString = {
    /**
     * Add or update a parameter to a URL query string by searching existing parameters with the same name.
     *
     * @param {string} url - The URL to be updated.
     * @param {string} name - The name of the parameter.
     * @param {mixed} value - The value of the parameter.
     */
    update: function (url, name, value) {
        var separator = url.indexOf('?') !== -1 ? "&" : "?";
        url = URLQueryString.remove(url, name);
        if (typeof value == "string" && value.split(',').length >= 2) {
            return URLQueryString.parameterizeArray(url, name, value.split(','));
        } else {
            return url + separator + name + "=" + value;
        }
    },

    /**
     * Remove an existing parameter or parameter array items from a URL.
     *
     * @param {string} url - The URL to be modified.
     * @param {string} name - The name of the parameter to be removed.
     */
    remove: function (url, name) {
        var urlparts = url.split('?');
        if (urlparts.length >= 2) {
            var prefix = encodeURIComponent(name) + '=';
            var prefixArr = encodeURIComponent(name) + '[]=';
            var pars = urlparts[1].split(/[&;]/g);
            //reverse iteration as may be destructive
            for (var i = pars.length; i-- > 0;) {
                //idiom for string.startsWith
                if (pars[i].lastIndexOf(prefix, 0) !== -1 || pars[i].lastIndexOf(prefixArr, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }
            url = urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
            return url;
        } else {
            return url;
        }
    },

    /**
     * Make array values individual parameters.
     *
     * @param {string} url - The URL to be updated.
     * @param {string} name - The name of the parameter.
     * @param {array} arr - The array to be parameterized.
     */
    parameterizeArray: function (url, name, arr) {
        var separator = url.indexOf('?') !== -1 ? "&" : "?";
        arr = arr.map(encodeURIComponent);
        return url + separator + name + '[]=' + arr.join('&' + name + '[]=');
    }

};

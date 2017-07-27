var entityMap = {
  "&": "&amp;",
  "<": "&lt;",
  ">": "&gt;",
  '"': '&quot;',
  "'": '&#39;',
  "/": '&#x2F;'
};

function escapeHtml(string) {
  return String(string).replace(/[&<>"'\/]/g, function (s) {
    return entityMap[s];
  });
}

function validateCafe(cafe, filter)
{
    if (!validateAttr(cafe, filter, 'wifi')) return false;

    if (!validateAttr(cafe, filter, 'seat')) return false;

    if (!validateAttr(cafe, filter, 'quiet')) return false;

    if (!validateAttr(cafe, filter, 'tasty')) return false;

    if (!validateAttr(cafe, filter, 'food')) return false;

    if (!validateAttr(cafe, filter, 'cheap')) return false;

    if (!validateAttr(cafe, filter, 'music')) return false;

    if (!validateAttrBool(cafe, filter, 'has_single_origin')) return false;

    if (!validateAttrBool(cafe, filter, 'has_dessert')) return false;

    if (!validateAttrBool(cafe, filter, 'has_meal')) return false;

    if (!validateSocket(cafe, filter)) return false;

    if (!validateLimitedTime(cafe, filter)) return false;

    if (filter.standing_desk && cafe.attr.standing_desk !== 'yes') return false;

    if (!validateBusinessType(cafe, filter)) return false;

    if (!validateAttrBool(cafe, filter, 'checkins')) return false;

    if (!validateBusinessHours(cafe, filter)) return false;

    return true;
}

function validateAttr(cafe, filter, attr)
{
    if (filter[attr] === '5' && cafe.attr[attr] < 5) {
        return false;
    } else if (filter[attr] === '4+' && cafe.attr[attr] < 4) {
        return false;
    } else if (filter[attr] === '3+' && cafe.attr[attr] < 3) {
        return false;
    }

    return true;
}

function validateAttrBool(cafe, filter, attr)
{
    if (filter[attr] && !cafe.attr[attr] ) {
        return false;
    }

    return true;
}

function validateSocket(cafe, filter)
{
    if (filter.socket === 'yes' && cafe.attr.socket !== 'yes') return false;

    if (filter.socket === 'maybe+' && cafe.attr.socket === 'no') return false;

    if (filter.socket === 'maybe+' && cafe.attr.socket === '') return false;

    return true;
}

function validateLimitedTime(cafe, filter)
{
    if (filter.limited_time === 'no' && cafe.attr.limited_time !== 'no') return false;

    if (filter.limited_time === 'maybe+' && cafe.attr.limited_time === 'yes') return false;

    if (filter.limited_time === 'maybe+' && cafe.attr.limited_time === '') return false;

    return true;
}

function validateBusinessType(cafe, filter)
{
    if (filter.business_type === true && cafe.attr.business_type !== 'local') return false;

    return true;
}

function validateBusinessHours(cafe, filter)
{
    if (filter.is_open === false) return true;

    var theDay = filter.is_open_at_day;

    var theTime = filter.is_open_at_time;

    var weekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    var workingBlocks = [];

    moment.locale('en');

    weekdays.map(function(weekday){
        var open = cafe.attr.business_hours[weekday].open;

        var close = cafe.attr.business_hours[weekday].close;

        if (open === null) return;

        if (open < close) {
            var start = moment().day(weekday).hour(open.split(':')[0]).minute(open.split(':')[1]);

            var end = moment().day(weekday).hour(close.split(':')[0]).minute(close.split(':')[1]);

            workingBlocks.push({start: start, end: end});
        } else if (open > close) {
            var start = moment().day(weekday).hour(open.split(':')[0]).minute(open.split(':')[1]);

            var end = moment().day(weekday).hour(close.split(':')[0]).minute(close.split(':')[1]).add(1, 'day');

            workingBlocks.push({start: start, end: end});
        }
    });

    var target = moment().day(theDay).hour(theTime.split(':')[0]).minute(theTime.split(':')[1]);

    for (var i in workingBlocks) {
        if (target.isBetween(workingBlocks[i].start, workingBlocks[i].end, null, '[)')) return true;
    }

    return false;
}

function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}

function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

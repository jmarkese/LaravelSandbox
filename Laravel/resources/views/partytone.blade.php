<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Political Party Tone</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/politicaltone.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="//d3js.org/d3.v3.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div id="democrat" class="col-sm-3 center">
                <p>Democratic Party</p>
                <p id="demMean"></p>
            </div>

            <div class="col-sm-1 center">vs.</div>
            <div id="republican" class="col-sm-3 center">
                <p>Republican Party</p>
                <p id="repMean"></p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function draw(data) {
            var margin = {top: 20, right: 15, bottom: 60, left: 60}
                , width = 960 - margin.left - margin.right
                , height = 500 - margin.top - margin.bottom;

            var x = d3.scale.linear()
                .domain([0, d3.max(data, function(d) { return d[0]; })])
                .range([ 0, width ]);

            var y = d3.scale.linear()
                .domain([d3.min(data, function(d) { return d[1]; }), d3.max(data, function(d) { return d[1]; })])
                .range([ height, 0 ]);

            var chart = d3.select('body')
                .append('svg:svg')
                .attr('width', width + margin.right + margin.left)
                .attr('height', height + margin.top + margin.bottom)
                .attr('class', 'chart')

            var main = chart.append('g')
                .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')')
                .attr('width', width)
                .attr('height', height)
                .attr('class', 'main')

            // draw the x axis
            var xAxis = d3.svg.axis()
                .scale(x)
                .orient('bottom');

            main.append('g')
                .attr('transform', 'translate(0,' + height + ')')
                .attr('class', 'main axis date')
                .call(xAxis);

            // draw the y axis
            var yAxis = d3.svg.axis()
                .scale(y)
                .orient('left');

            console.log(y);

            main.append('g')
                .attr('transform', 'translate(0,0)')
                .attr('class', 'main axis date')
                .call(yAxis);

            var g = main.append("svg:g");

            g.selectAll("scatter-dots")
                .data(data)
                .enter().append("svg:circle")
                .attr("cx", function (d,i) { return x(d[0]); } )
                .attr("cy", function (d) { return y(d[1]); } )
                .attr("r", 2)
                .attr("class", function(d) { return d[2] });

            var demMean = d3.mean(data.filter(function(d) {
                return d[2] == "d";
            }),function(d) { return +d[1]});

            var repMean = d3.mean(data.filter(function(d) {
                return d[2] == "r";
            }),function(d) { return +d[1]});

            d3.select('#repMean').text(repMean);
            d3.select('#demMean').text(demMean);

        }
        d3.json("{{route('partytonedata')}}", draw);
    </script>
</body>
</html>


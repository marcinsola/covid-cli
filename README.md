# covid-cli
This is a simple CLI tool keep track on covid statistics through your terminal. I used https://github.com/javieraviles/covidAPI as a data source.

# Initilization
After cloning the repository, just install the dependencies via *composer install*

# Usage
Simply type **php covid.php** to get the data in a form of a table.
You can choose a specific country by providing an argument after the script call.
E.g. **php covid.php poland**
If the country name consists of more than one word, you'll need to put the country name in quotes (case doesn't matter).

Output format can be changed by providing an *--output/-o* option, like so:
**php covid.php -o csv**

That way you are able to print the output to the terminal or to the file:
**php covid.php <optional_country_name> -o json > your_json_file.json**

Available formats are: table (default), csv, json, xml, yaml.

You can sort the results by numeric columns using *--sort/-s* option
**php covid.php -s recovered**

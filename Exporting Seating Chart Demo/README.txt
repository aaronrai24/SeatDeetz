This is my solution to the exporting Seating Chart functionality.

Originally, I wanted to create all the scripts by hand but it was too difficult to implement. I decided to use the
script called, 'HTML2Canvas'. This is what happens in the current implementation:

	1.) A DIV is created that holds the element we want to capture. (ID = "Outer")
	2.) Another DIV wraps around the other DIV, that contains width and height style data. (ID = "Capture")
	3.) Once the export button is clicked, HTML2Canvas creates a Canvas of the Outer DIV.
	4.) The Canvas is then converted to BASE64 and acts as a URL to our canvas.
	5.) We then tie our URL to a file name and add the URL to the page.
	6.) The URL is automatically clicked on, and the image is downloaded.
	7.) The URL is now removed from the webpage.

What do you think of this solution?

If you like this solution then we can merge it with seatingChart.php

I included the complete and min scripts of HTML2Canvas, so you can look over them. But when we reach production, we need
to remove the complete script.

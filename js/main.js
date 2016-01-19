function node_clear(name)
{
	var node = document.getElementById(name);
	while (node.hasChildNodes())
	{
	    node.removeChild(node.firstChild);
	}
}
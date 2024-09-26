import "./bootstrap";

import Alpine from "alpinejs";
import Clipboard from "@ryangjchandler/alpine-clipboard";
import Htmx from "htmx.org";

Alpine.plugin(Clipboard);

window.Alpine = Alpine;

Alpine.start();

window.htmx = Htmx;

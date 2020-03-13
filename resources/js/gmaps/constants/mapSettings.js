import colorPalette from "./colorPalette";

const {
    COLOR_LANDSCAPE,
    COLOR_BORDERS,
    COLOR_WATER,
    COLOR_LINE,
    COLOR_POINT_FILL,
    COLOR_SELECTED_POINT
} = colorPalette;

const COLORS = {
    BORDERS: COLOR_BORDERS,
    LANDSCAPE: COLOR_LANDSCAPE,
    LINE: COLOR_LINE,
    POINT: COLOR_SELECTED_POINT,
    POINT_FILL: COLOR_POINT_FILL,
    WATER: COLOR_WATER
};

const POINT_MARKER_ICON_CONFIG = {
    path: "M 0, 0 m -5, 0 a 5,5 0 1,0 10,0 a 5,5 0 1,0 -10,0",
    strokeOpacity: 0.7,
    strokeWeight: 4,
    strokeColor: COLORS.POINT,
    fillColor: COLORS.POINT_FILL,
    fillOpacity: 0.7,
    scale: 2
};

const LINE_SYMBOL_CONFIG = {
    path: "M 0,-2 0,2",
    strokeOpacity: 1,
    strokeWeight: 2,
    scale: 1
};

const LINE_PATH_CONFIG = {
    clickable: false,
    geodesic: true,
    // strokeOpacity: 0.8,
    // strokeWeight: 10,
    // strokeColor: COLORS.LINE,
    // icons: [{
    //     icon: LINE_SYMBOL_CONFIG,
    //     repeat: "10px"
    // }]
};

const mapSettings = {
    clickableIcons: true,
    streetViewControl: false,
    panControlOptions: false,
    gestureHandling: "cooperative",
    backgroundColor: COLORS.LANDSCAPE,
    mapTypeControl: false,
    zoomControlOptions: {
        style: "SMALL"
    },
    zoom: 12,
    minZoom: 2,
    maxZoom: 100,
    styles:[]
};

export {
    mapSettings,
    LINE_PATH_CONFIG,
    POINT_MARKER_ICON_CONFIG
};

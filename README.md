<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## API Endpoints

GET|HEAD       api/points<br>
GET|HEAD       api/points/{point}<br>
GET|HEAD       api/points/nearby<br>
GET|HEAD       api/points/geojson<br>
GET|HEAD       api/points/{id}/geojson<br>
GET|HEAD       api/routes<br>
GET|HEAD       api/routes/{route}<br>
GET|HEAD       api/routes/{id}/points<br>
GET|HEAD       api/routes/{id}/tags<br>
GET|HEAD       api/routes/nearby<br>

### Points Resource

#### Get all points
- **GET** `/api/points`
- Returns: List of all points in the system

#### Get a specific point
- **GET** `/api/points/{point}`
- Parameters: `point` (ID of the point)
- Returns: Details of the specified point

#### Find nearby points
- **GET** `/api/points/nearby`
- Parameters: requires latitude, longitude, and radius
- Returns: List of points within the specified area

#### Get all points as GeoJSON
- **GET** `/api/points/geojson`
- Returns: All points formatted as GeoJSON feature collection

#### Get specific point as GeoJSON
- **GET** `/api/points/{id}/geojson`
- Parameters: `id` (Point ID)
- Returns: Single point formatted as GeoJSON feature

### Routes Resource

#### Get all routes
- **GET** `/api/routes`
- Returns: List of all routes in the system

#### Get a specific route
- **GET** `/api/routes/{route}`
- Parameters: `route` (ID of the route)
- Returns: Details of the specified route

#### Get points for a route
- **GET** `/api/routes/{id}/points`
- Parameters: `id` (Route ID)
- Returns: List of points associated with the specified route

#### Get tags for a route
- **GET** `/api/routes/{id}/tags`
- Parameters: `id` (Route ID)
- Returns: List of tags associated with the specified route

#### Find nearby routes
- **GET** `/api/routes/nearby`
- Parameters: requires latitude, longitude, and radius.
- Returns: List of routes within the specified area

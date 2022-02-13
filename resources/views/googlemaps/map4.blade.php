<div style="display: none">
    <input
      id="origin-input"
      class="controls"
      type="text"
      placeholder="Enter an origin location"
    />

    <div id="mode-selector" class="controls">
      <input
        type="radio"
        name="type"
        id="changemode-walking"
        checked="checked"
      />
      <label for="changemode-walking">Walking</label>

      <input type="radio" name="type" id="changemode-transit" />
      <label for="changemode-transit">Transit</label>

      <input type="radio" name="type" id="changemode-driving" />
      <label for="changemode-driving">Driving</label>
    </div>
  </div>

<div id="map"></div>

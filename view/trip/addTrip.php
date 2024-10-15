<div class="contenido">

    <div class="model-box-default">
        <h2>Añadir ofertas de viaje</h2><br>

        <form id="trip" action="index.php?controller=trip&action=addTrip" method="POST" >

        <div class="form-section active" id="section1">
                <label for="title">Título</label>
                <input class="input-box" type="text" id="title" name="title" title="Ingrese un título" maxlength="45"
                    placeholder="Ingrese un título">
                <div class="errorMessage" id="errorMessagetitle"></div>

                <label for="departureLocation">Lugar de salida</label>
                <input class="input-box" type="text" id="departureLocation" name="departureLocation"
                    title="Ingrese el lugar de salida" maxlength="45" placeholder="Ingrese el lugar de salida">
                <div class="errorMessage" id="errorMessagedepartureLocation"></div>

                <label for="departureDate">Fecha de salida</label>
                <input class="input-box" type="date" id="departureDate" name="departureDate"
                    title="Selecciona la fecha de salida">
                <div class="errorMessage" id="errorMessagedepartureDate"></div>

                <label for="departureTime">Hora de salida</label>
                <input class="input-box" type="time" id="departureTime" name="departureTime"
                    title="Selecciona la hora de salida">
                <div class="errorMessage" id="errorMessagedepartureTime"></div>
                <button class="button-Rev" type="button" onclick="nextSection()">Siguiente</button>
        </div>
        <div class="form-section" id="section2">
                <label for="returnDate">Fecha de regreso</label>
                <input class="input-box" type="date" id="returnDate" name="returnDate"
                    title="Selecciona la fecha de regreso">
                <div class="errorMessage" id="errorMessagereturnDate"></div>

                <label for="returnTime">Hora de regreso</label>
                <input class="input-box" type="time" id="returnTime" name="returnTime"
                    title="Selecciona la hora de regreso">
                <div class="errorMessage" id="errorMessagereturnTime"></div>

                <label for="numberSlots">Cantidad de cupos</label>
                <input class="input-box" type="text" id="numberSlots" name="numberSlots"
                    title="Ingrese la cantidad de cupos" maxlength="10" placeholder="Ingrese la cantidad de cupos">
                <div class="errorMessage" id="errorMessagenumberSlots"></div>

                <label for="price">Precio del viaje</label>
                <input class="input-box" type="text" id="price" name="price" title="Ingrese el costo del viaje"
                    maxlength="11" placeholder="Ingrese el costo del viaje">
                <div class="errorMessage" id="errorMessageprice"></div>
                <button class="button-Rev" type="button" onclick="previousSection()">Anterior</button>
                <button class="button-Rev" type="button" onclick="nextSection()">Siguiente</button>
        </div>   
        <div class="form-section" id="section2">
                <?php 
                require_once("view/trip/add2Trip.php");
                ?>
                <button class="button-Rev" type="button" onclick="previousSection()">Anterior</button>
                <button class="button-Rev" type="button" onclick="nextSection()">Siguiente</button>
            </div>
            <div class="form-section" id="section2">
                <?php 
                require_once("view/trip/add3Trip.php");
                ?>
                <button class="button-Rev" type="button" onclick="previousSection()">Anterior</button>
                <button type="submit">Enviar</button>
            </div>
            <input class="button-login-register" type="submit" title="Añadir Oferta de Viaje" value="Añadir"
                name="send">
        </form>
        <script src="asset/js/requests/requestsTrip.js"></script>
        <a href="index.php?controller=trip&action=listTripEnabled" title="Cancelar"><button
                class="button-Rev">Cancelar</button></a>
    </div>
</div>
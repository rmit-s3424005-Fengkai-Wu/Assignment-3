
        <div class="content content_font">
            <table>
                <tr>
                    <th>Price List</th>
                    <th>Mon - Tue (All Day)<br>Wed - Fri (1pm only)</th>
                    <th>Wed - Fri (not 1pm)<br>Sat - Sun (All Day)</th>
                </tr>
                <tr>
                    <td>Standard-Full
                        <br>Standard-Conc
                        <br>Standard-Child
                        <br><br>FirstClass-Adult
                        <br>FirstClass-Child
                        <br>Beanbag*
                    </td>
                    <td>$12
                        <br>$10
                        <br>$8
                        <br><br>$25
                        <br>$20
                        <br>$20
                    </td>
                    <td>$18
                        <br>$15
                        <br>$12
                        <br><br>$30
                        <br>$25
                        <br>$30
                    </td>
                </tr>
            </table>
            * Beanbag price allows up to 2 adults OR 1 adult + 1 child OR up to 3 children. One price fits all!
            
            <form action="http://titan.csit.rmit.edu.au/~s3424005/wp/a3/cart.php" method="post" >
                <br><br><table id="file_table">
                    <tr>
                        <th>Film Name</th>
                        <td><select tabIndex="1" id="movie_selecter" name="film" onchange="change_day_selecter();calculate_price();"></select>
                    </tr>
                    <tr>
                        <th>Session Day</th>
                        <td><select tabIndex="2" id="day_selecter" name="day" onchange="change_time_selecter();calculate_price()"></select>
                    </tr>
                    <tr>
                        <th>Session Time</th>
                        <td><select tabIndex="3" id="time_selecter" name="time" onchange="calculate_price()"></select>
                    </tr>
                </table>

                <br><br><table id="ticket_table">
                    <tr>
                        <th>Ticket Type</th>
                        <th>Quantity</th>
                        <th>Subtotal Price</th>
                    </tr>
                    <tr>
                        <td>Adult</td>
                        <td><input tabIndex="4" name = "SA" class="ticket_quantity" type="text" value="0" onchange="quantity_self_check(this);calculate_price()" required onkeyup="this.value=this.value.replace(/[^\d]/g,'')"></td>
                        <td>$<span class="price">0.00</span></td>
                    </tr>
                    <tr>
                        <td>Concession</td>
                        <td><input tabIndex="5" name = "SP" class="ticket_quantity" type="text" value="0" onchange="quantity_self_check(this);calculate_price()" required onkeyup="this.value=this.value.replace(/[^\d]/g,'')"></td>
                        <td>$<span class="price">0.00</span></td>
                    </tr>
                    <tr>
                        <td>Child</td>
                        <td><input tabIndex="6" name = "SC" class="ticket_quantity" type="text" value="0" onchange="quantity_self_check(this);calculate_price()" required onkeyup="this.value=this.value.replace(/[^\d]/g,'')"></td>
                        <td>$<span class="price">0.00</span></td>
                    </tr>
                    <tr>
                        <td>First Class Adult</td>
                        <td><input tabIndex="7" name = "FA" class="ticket_quantity" type="text" value="0" onchange="quantity_self_check(this);calculate_price()" required onkeyup="this.value=this.value.replace(/[^\d]/g,'')"></td>
                        <td>$<span class="price">0.00</span></td>
                    </tr>
                    <tr>
                        <td>First Class Child</td>
                        <td><input tabIndex="8" name = "FC" class="ticket_quantity" type="text" value="0" onchange="quantity_self_check(this);calculate_price()" required onkeyup="this.value=this.value.replace(/[^\d]/g,'')"></td>
                        <td>$<span class="price">0.00</span></td>
                    </tr>
                    <tr>
                        <td>Beanbag - 1 Person</td>
                        <td><input tabIndex="9" name = "B1" class="ticket_quantity" type="text" value="0" onchange="quantity_self_check(this);calculate_price()" required onkeyup="this.value=this.value.replace(/[^\d]/g,'')"></td>
                        <td>$<span class="price">0.00</span></td>
                    </tr>
                    <tr>
                        <td>Beanbag - 2 Person</td>
                        <td><input tabIndex="10" name = "B2" class="ticket_quantity" type="text" value="0" onchange="quantity_self_check(this);calculate_price()" required onkeyup="this.value=this.value.replace(/[^\d]/g,'')"></td>
                        <td>$<span class="price">0.00</span></td>
                    </tr>
                    <tr>
                        <td>Beanbag - 3 Person</td>
                        <td><input tabIndex="11" name = "B3" class="ticket_quantity" type="text" value="0" onchange="quantity_self_check(this);calculate_price()" required onkeyup="this.value=this.value.replace(/[^\d]/g,'')"></td>
                        <td>$<span class="price">0.00</span></td>
                    </tr>
                    <tr>
                        <th colspan="2">Total Price</th>
                        <td><input name = "price" id="total_price" type="text" value="$0.00" required readonly/></td>
                    </tr>
                    <tr>
                        <th colspan="3"><input tabIndex="12" type="submit" value="Submit"></th>
                    <tr>
                </table>
            </form>
        </div>
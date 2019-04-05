import React, { Component } from 'react';
import Board from './Board';
import LightningCounterDisplay from './Reloj'
	class Game extends React.Component{
			refreshPage(){ 
                window.location.reload(); 
            }
                
                render(){
                    
                    var estylo={
                        justifyContent: 'center',
                        textAlign: 'center',
                        display: "flex",
                    }
                    
					return (
						<div className="game" style={estylo} >
							<div className="game-board">
								<Board/>
                                <div><LightningCounterDisplay/></div>
                                <button type="button" onClick={ this.refreshPage }> <span>Otra Vez!!!</span> </button> 
							</div>
							
						</div>
					);
				}
                
                
			}

export default Game;	
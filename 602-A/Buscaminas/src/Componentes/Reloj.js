import React, { Component } from 'react';

class LightningCounter extends React.Component{
				
				constructor(props,context){
					super(props,context);
						this.state={
							counter:0,
							segundos: 0,
							minutos: 0,
							horas: 0
						};
					this.timerTick=this.timerTick.bind(this);
				}
				
				timerTick(){

					var nuevoEst={};
					if(this.state.segundos==59){
						nuevoEst.segundos=0;
						nuevoEst.minutos=this.state.minutos+1;
					}else{
						nuevoEst.segundos=this.state.segundos+1;

				}

					if(this.state.minutos==59 && this.state.segundos==59){
						nuevoEst.minutos=0;
						nuevoEst.horas=this.state.horas+1;
					}


					this.setState(
						nuevoEst

					);
				}

				componentDidMount(){
					setInterval(this.timerTick,1000);
			
				}

				render(){
					return(
						<p>{this.state.horas}:{this.state.minutos}:{this.state.segundos}</p>
					); 
				}
				



			}

class LightningCounterDisplay extends React.Component{
				render(){
					var divStyle={
						width:290,
						height: 70,
                        textAlign:"center",
						backgroundColor: "black",
						padding: 5,
						fontFamily: "sans-serif",
						color:"#999",
						
				};

					return (
				        <div style={divStyle}>
                            <p>Tiempo transcurrido:     <LightningCounter/></p>
						
                        </div>
                        );				
					}
				}
		


export default LightningCounterDisplay;	
import React, { Component } from 'react';
import Square from './Square';

			class Board extends React.Component{
                constructor(props){
					super(props);
					this.state={
						squares:Array(81).fill(null),
                        tabla: Array(81).fill(null),    
                        estilo: Array(81).fill(null),
                        minas: Array(10).fill(null),
                    };
                    
                    this.inicializar();
				}
			
            inicializar(){
                var arr=[];
                var aleatorio;
                var cont=0;
                
                var nEstP={
                    backgroundColor:"#46FF33",
                };
                var nEst={
                    backgroundColor: "#1B990E",
                };
                
                for(var m=0;m<81;m++){
                    if(m%2==0){
                        this.state.estilo[m]=nEstP;
                    }else{
                    this.state.estilo[m]=nEst;
                    }
                }
                
                while(cont<10){
                    aleatorio = Math.round(Math.random()*80);
                    while(this.noExiste(aleatorio,arr)){
                            aleatorio = Math.round(Math.random()*80);
                            arr.push(aleatorio);
                            cont++;
                    }
                    aleatorio = Math.round(Math.random()*80);
                    arr.push(aleatorio);
                    cont++;
                    
                    
                }
                this.state.minas=arr.slice();
                var num=0;
                for(var i=0;i<10;i++){
                    num=arr[i];
                    this.state.squares[num]='M';
                }
                
                var cant;
                
                for(var k=0;k<81;k++){
                    if(this.state.squares[k]!='M'){
                        if(k==0){
                           cant=this.calculaEsq(k,1,9,10) 
                            this.state.squares[k]=cant;
                        }
                        if(k==8){
                           cant=this.calculaEsq(k,-1,8,9) 
                            this.state.squares[k]=cant;
                        }
                        if(k==72){
                           cant=this.calculaEsq(k,1,-8,-9) 
                            this.state.squares[k]=cant;
                        }
                        if(k==80){
                           cant=this.calculaEsq(k,-1,-9,-10) 
                            this.state.squares[k]=cant;
                        }
                        if(this.determinar(k)==1){
                            cant=this.calculaBorde(k,-1,1,8,9,10);
                            this.state.squares[k]=cant;
                            
                        }
                        if(this.determinar(k)==2){
                            cant=this.calculaBorde(k,-9,1,-8,9,10);
                            this.state.squares[k]=cant;   
                        }
                        
                        if(this.determinar(k)==3){
                            cant=this.calculaBorde(k,-9,-1,8,9,-10);
                            this.state.squares[k]=cant;   
                        }
                        
                        if(this.determinar(k)==4){
                            cant=this.calculaBorde(k,-10,-9,-8,-1,1);
                            this.state.squares[k]=cant;   
                        }
                        
                        if(this.centro(k)==0){
                            cant=this.calculaResto(k,-10,-9,-8,-1,1,8,9,10)
                            this.state.squares[k]=cant;
                        }
                        
                    }
                }
                
                
            }
            
            calculaResto(p,n1,n2,n3,n4,n5,n6,n7,n8){
                var num=0;
                if(this.state.squares[p+n1]=='M')
                    num++;
                if(this.state.squares[p+n2]=='M')
                    num++;
                if(this.state.squares[p+n3]=='M')
                    num++;
                if(this.state.squares[p+n4]=='M')
                    num++;
                if(this.state.squares[p+n5]=='M')
                    num++;
                if(this.state.squares[p+n6]=='M')
                    num++;
                if(this.state.squares[p+n7]=='M')
                    num++;
                if(this.state.squares[p+n8]=='M')
                    num++;
            
                
                return num;
                
            }
                
                
            calculaBorde(pos,n1,n2,n3,n4,n5){
                var num=0;
                if(this.state.squares[pos+n1]=='M')
                    num++;
                if(this.state.squares[pos+n2]=='M')
                    num++;
                if(this.state.squares[pos+n3]=='M')
                    num++;
                if(this.state.squares[pos+n4]=='M')
                    num++;
                if(this.state.squares[pos+n5]=='M')
                    num++;
            
                return num;
                
            }
                
            calculaEsq(pos,f,c,e){
                var num=0;
                if(this.state.squares[pos+f]==='M')
                    num++;
                if(this.state.squares[pos+c]==='M')
                    num++;
                if(this.state.squares[pos+e]==='M')
                    num++;
            
                return num;
                
            }
            
            determinar(num){
                var cima=[73,74,75,76,77,78,79];
                var izq=[9,18,27,36,45,54,63];
                var der=[17,26,35,44,53,62,71];
                var abajo=[1,2,3,4,5,6,7];
                
                if(this.noExiste(num,abajo)==-1)
                    return 1;
                
                if(this.noExiste(num,izq)==-1)
                    return 2;
                
                if(this.noExiste(num,der)==-1)
                    return 3;
                
                if(this.noExiste(num,cima)==-1)
                    return 4;
                
            }    
            
                
            centro(num){
                var cima=[73,74,75,76,77,78,79];
                var izq=[9,18,27,36,45,54,63];
                var der=[17,26,35,44,53,62,71];
                var abajo=[1,2,3,4,5,6,7];
                
                var band=0;
                
                if(this.noExiste(num,abajo)==-1)
                    band=1;
                
                if(this.noExiste(num,izq)==-1)
                     band=1;
                
                if(this.noExiste(num,der)==-1)
                     band=1;
                
                if(this.noExiste(num,cima)==-1)
                     band=1;
                
                return band;
            }
                
            noExiste(num,arr){
                for(var i=0;i<10;i++){
                    if(arr[i]===num){
                        return -1;
                    }
                }
                return 0;
            }
          

			handleClick(i){
				const estado=this.state.tabla.slice();
                const nEst={
                    backgroundColor: "#0E1299",
                    color:"#F33779",
                    
                };
                
                const minaP={
             //       backgroundColor:"#46FF33",
                    background: "red",
                };
                
                const mina2={
            //        backgroundColor:"#1B990E",
                    background: "Orange",
                };
                
                if(this.state.squares[i]!='M'){
                    this.state.estilo[i]=nEst;
                    estado[i]=this.state.squares[i];                    
                
                    this.setState({
					tabla:estado,
				    });
                
                }
                else{
                    if(i%2==0)
                        this.state.estilo[i]=minaP;
                    else    
                        this.state.estilo[i]=mina2;
                    
                
                    for(var i=0;i<81;i++){
                        if(this.state.squares[i]=='M'){
                            estado[i]=this.state.squares[i];
                            this.state.estilo[i]=minaP;
                        }
                    }    
                    
                
                    this.setState({
					tabla:estado,
				    });
                    
                    alert("Usted ha perdido");
                }
              
                
                var w=this.winner();
                    
                if(w==0){
                    for(var i=0;i<81;i++){
                        if(this.state.squares[i]=='M'){
                            estado[i]='E';
                            this.state.estilo[i]=minaP;
                        }
                    }    
                    
                    
                    this.setState({
					tabla:estado,
				    });
                    
                    
                    alert("Usted gana")
                }
                
            }
                
            winner(){
                var band=0;
                var band2=0;
                for(var i=0;i<81;i++){
                    if(this.noExiste(i,this.state.minas)==0){ //Si no es una mina
                        if(this.state.tabla[i]==null){
                            return 1;
                        }
                    }
                    
                        
                }
                return 0;
            }    

            renderSquare(i){
                return <Square style={this.state.estilo[i]} value={this.state.tabla[i]} onClick={()=> this.handleClick(i)} />;
            }

				
				

				render(){
				return(
					<div>
						<div className="board-row">
							{this.renderSquare(0)}
							{this.renderSquare(1)}
							{this.renderSquare(2)}
                            {this.renderSquare(3)}
							{this.renderSquare(4)}
							{this.renderSquare(5)}
							{this.renderSquare(6)}
							{this.renderSquare(7)}
							{this.renderSquare(8)}
                        </div>
						<div className="board-row">
							{this.renderSquare(9)}
							{this.renderSquare(10)}
							{this.renderSquare(11)}
                            {this.renderSquare(12)}
							{this.renderSquare(13)}
							{this.renderSquare(14)}
							{this.renderSquare(15)}
							{this.renderSquare(16)}
							{this.renderSquare(17)}
						</div>
						<div className="board-row">
							{this.renderSquare(18)}
							{this.renderSquare(19)}
							{this.renderSquare(20)}
                            {this.renderSquare(21)}
							{this.renderSquare(22)}
							{this.renderSquare(23)}
							{this.renderSquare(24)}
							{this.renderSquare(25)}
							{this.renderSquare(26)}
                        </div>
                        <div className="board-row">
							{this.renderSquare(27)}
							{this.renderSquare(28)}
							{this.renderSquare(29)}
                            {this.renderSquare(30)}
							{this.renderSquare(31)}
							{this.renderSquare(32)}
							{this.renderSquare(33)}
							{this.renderSquare(34)}
							{this.renderSquare(35)}
                        </div>
						<div className="board-row">
							{this.renderSquare(36)}
							{this.renderSquare(37)}
							{this.renderSquare(38)}
                            {this.renderSquare(39)}
							{this.renderSquare(40)}
							{this.renderSquare(41)}
							{this.renderSquare(42)}
							{this.renderSquare(43)}
							{this.renderSquare(44)}
                        </div>
						<div className="board-row">
							{this.renderSquare(45)}
							{this.renderSquare(46)}
							{this.renderSquare(47)}
                            {this.renderSquare(48)}
							{this.renderSquare(49)}
							{this.renderSquare(50)}
							{this.renderSquare(51)}
							{this.renderSquare(52)}
							{this.renderSquare(53)}
                        </div>
						<div className="board-row">
							{this.renderSquare(54)}
							{this.renderSquare(55)}
							{this.renderSquare(56)}
                            {this.renderSquare(57)}
							{this.renderSquare(58)}
							{this.renderSquare(59)}
							{this.renderSquare(60)}
							{this.renderSquare(61)}
							{this.renderSquare(62)}
                        </div>
						<div className="board-row">
							{this.renderSquare(63)}
							{this.renderSquare(64)}
							{this.renderSquare(65)}
                            {this.renderSquare(66)}
							{this.renderSquare(67)}
							{this.renderSquare(68)}
							{this.renderSquare(69)}
							{this.renderSquare(70)}
							{this.renderSquare(71)}
                        </div>
						<div className="board-row">
							{this.renderSquare(72)}
							{this.renderSquare(73)}
							{this.renderSquare(74)}
                            {this.renderSquare(75)}
							{this.renderSquare(76)}
							{this.renderSquare(77)}
							{this.renderSquare(78)}
							{this.renderSquare(79)}
							{this.renderSquare(80)}
                        </div>
								
                </div>
				);
			}
		}

export default Board;	
import React, {Component} from 'react';
import styles from './App.module.css';
import Button from '@material-ui/core/Button';
import ButtonGroup from '@material-ui/core/ButtonGroup';
import {Link} from 'react-router-dom';

class App extends Component {
    state = {
        listMedia: null,
        total: 5,
        per_page: 5,
        current_page: 1
    };

    componentDidMount() {
        this.makeHttpRequestWithPage(1);
    }

    makeHttpRequestWithPage = async pageNumber => {
        if (pageNumber == undefined){
            return;
        }
        const response = await fetch(`http://localhost:8100/media/find-by/${pageNumber}/${this.state.per_page}/media-id/asc/`, {
            method: 'GET'
        });

        const data = await response.json();

        this.setState({
            listMedia: data.media_vo,
            total: data.total,
            per_page: data.current_max,
            current_page: data.current_first
        });
    };

    async changeLimit(event) {
        await this.setState({per_page: event.target.options.selectedIndex});
        await this.makeHttpRequestWithPage(1);
    }

    render = _ => {
        let mediaBuild, renderPageNumbers, lastPage;

        if (this.state.listMedia !== null) {
            mediaBuild = this.state.listMedia.map(media => (
                <tr key={media.id}>
                    <td>{media.id}</td>
                    <td>{media.title}</td>
                    <td>{media.description}</td>
                    <td>{media.type.description}</td>   
                    <td>
                        <ButtonGroup size="small" aria-label="small outlined button group">
                            <Button><Link to={`/media-update/${media.id}`} >editar</Link></Button>
                            <Button><Link to={`/media-delete/${media.id}`} >excluir</Link></Button>
                            <Button>
                                <Link to={`/media-loan/${media.id}`} >situação/emprestar/devolver</Link>
                            </Button>
                        </ButtonGroup>
                    </td>                   
                </tr>
            ));
        }

        const pageNumbers = [];
        if (this.state.total !== null) {
            let valueCeil = Math.ceil(this.state.total / this.state.per_page);
            for (let i = 1; i <= valueCeil; i++) {
                pageNumbers.push(i);
            }
            lastPage = Math.max.apply(Math, pageNumbers);

            if(lastPage == '-Infinity') {
                lastPage = 1;
            }       

            renderPageNumbers = pageNumbers.map(number => {
                let classes = this.state.current_page === number ? styles.active : '';

                return (
                    <span key={number}
                          className={classes}
                          onClick={() => this.makeHttpRequestWithPage(number)}>
                        {number}
                    </span>
                );
            });
        }

        return (
            <div className={styles.app}>              
                <select onChange={(val) => this.changeLimit(val)}>   
                    <option value={1}>selecione um item</option>                
                    <option value={1}>1</option>
                    <option value={2}>2</option>
                    <option value={3}>3</option>
                    <option value={4}>4</option>
                    <option value={5}>5</option>
                    <option value={6}>6</option>
                    <option value={7}>7</option>    
                    <option value={8}>8</option>
                    <option value={9}>9</option>                    
                    <option value={10}>10</option>
                </select>

                <table className={styles.table}>
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Tipo</th>
                        <th>
                             <Button variant="outlined" color="primary">
                                <Link to={`/media-create`} >Cadastrar Mídia</Link>
                             </Button> 
                             <Button variant="outlined" color="primary">
                                <Link to={`/person-create`} >Cadastrar Pessoa</Link>
                             </Button>                            
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {mediaBuild}
                    </tbody>
                </table>

                  <div className={styles.pagination}>
                    <span onClick={() => this.makeHttpRequestWithPage(1)}>&laquo;</span>
                    {renderPageNumbers}
                   <span onClick={() => this.makeHttpRequestWithPage(lastPage)}>&raquo;</span>
                 </div>
                
          
                   
            

            </div>
        );
    };
}

export default App;
